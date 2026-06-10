<?php

declare(strict_types=1);

namespace Tests\Feature\Admin;

use App\Enums\EventStatus;
use App\Enums\PayoutStatus;
use App\Enums\PayoutType;
use App\Models\Event;
use App\Models\Payout;
use App\Models\User;
use App\Notifications\FinalPayoutDisbursedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

final class MidtransIrisPayoutTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    private User $organizer;

    private Event $event;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->admin()->create();
        $this->organizer = User::factory()->organizer()->create();

        $this->organizer->organizerProfile()->create([
            'organization_name' => 'Test Org',
            'phone' => '08123456789',
            'bank_name' => 'BCA',
            'bank_account_number' => '1234567890',
            'bank_account_name' => 'Test Organizer Bank Account',
        ]);

        $this->event = Event::factory()->create([
            'organizer_id' => $this->organizer->id,
            'status' => EventStatus::Completed,
        ]);
    }

    /**
     * Test approving a final payout triggers Midtrans Iris API.
     */
    public function test_admin_approving_final_payout_triggers_midtrans_iris(): void
    {
        $payout = Payout::factory()->pending()->create([
            'event_id' => $this->event->id,
            'organizer_id' => $this->organizer->id,
            'payout_type' => PayoutType::Final,
            'net_amount' => 500000,
            'payout_bank_name' => 'BCA',
            'payout_account_number' => '1234567890',
            'payout_account_holder' => 'Test Organizer Bank Account',
        ]);

        Http::fake([
            'https://app.sandbox.midtrans.com/iris/api/v1/payouts' => Http::response([
                'payouts' => [
                    [
                        'reference_no' => 'IRIS-REF-100',
                        'status' => 'created',
                        'amount' => '500000.00',
                    ],
                ],
            ], 201),
        ]);

        $response = $this->actingAs($this->admin)
            ->put(route('admin.payouts.approve', $payout));

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Payout approved for disbursement.');

        $payout->refresh();
        $this->assertEquals(PayoutStatus::Processing, $payout->status);
        $this->assertEquals('IRIS-REF-100', $payout->midtrans_reference);
        $this->assertEquals($this->admin->id, $payout->reviewed_by);

        Http::assertSent(function ($request) {
            return $request->url() === 'https://app.sandbox.midtrans.com/iris/api/v1/payouts' &&
                $request['payouts'][0]['bank'] === 'bca' &&
                $request['payouts'][0]['amount'] === '500000' &&
                $request['payouts'][0]['beneficiary_account'] === '1234567890';
        });
    }

    /**
     * Test approving payout with an unsupported bank throws a validation exception.
     */
    public function test_admin_approving_final_payout_with_invalid_bank_fails(): void
    {
        $payout = Payout::factory()->pending()->create([
            'event_id' => $this->event->id,
            'organizer_id' => $this->organizer->id,
            'payout_type' => PayoutType::Final,
            'payout_bank_name' => 'Invalid Bank Name Extra Long',
            'payout_account_number' => '1234567890',
        ]);

        $response = $this->actingAs($this->admin)
            ->put(route('admin.payouts.approve', $payout));

        $response->assertRedirect();
        $response->assertSessionHas('error');

        $payout->refresh();
        // Should remain pending and not transition to processing
        $this->assertEquals(PayoutStatus::Pending, $payout->status);
        $this->assertNull($payout->midtrans_reference);
    }

    /**
     * Test approving payout handles Midtrans API errors gracefully.
     */
    public function test_admin_approving_final_payout_with_api_error_fails(): void
    {
        $payout = Payout::factory()->pending()->create([
            'event_id' => $this->event->id,
            'organizer_id' => $this->organizer->id,
            'payout_type' => PayoutType::Final,
            'net_amount' => 500000,
            'payout_bank_name' => 'BCA',
            'payout_account_number' => '1234567890',
            'payout_account_holder' => 'Test Organizer Bank Account',
        ]);

        Http::fake([
            'https://app.sandbox.midtrans.com/iris/api/v1/payouts' => Http::response([
                'message' => 'Insufficient Balance',
            ], 400),
        ]);

        $response = $this->actingAs($this->admin)
            ->put(route('admin.payouts.approve', $payout));

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Insufficient Balance');

        $payout->refresh();
        $this->assertEquals(PayoutStatus::Pending, $payout->status);
        $this->assertNull($payout->midtrans_reference);
    }

    /**
     * Test webhook callback securely resolves and updates payout status.
     */
    public function test_webhook_callback_securely_updates_payout_status(): void
    {
        Notification::fake();

        $payout = Payout::factory()->processing()->create([
            'event_id' => $this->event->id,
            'organizer_id' => $this->organizer->id,
            'payout_type' => PayoutType::Final,
            'midtrans_reference' => 'IRIS-REF-200',
        ]);

        Http::fake([
            'https://app.sandbox.midtrans.com/iris/api/v1/payouts/IRIS-REF-200' => Http::response([
                'reference_no' => 'IRIS-REF-200',
                'status' => 'completed',
                'amount' => '500000.00',
            ], 200),
        ]);

        $response = $this->withServerVariables(['REMOTE_ADDR' => '103.208.23.1']) // Authorized Midtrans IP
            ->postJson(route('payout.callback'), [
                'reference_no' => 'IRIS-REF-200',
                'status' => 'completed',
            ]);

        $response->assertOk();
        $response->assertSee('OK');

        $payout->refresh();
        $this->assertEquals(PayoutStatus::Completed, $payout->status);
        $this->assertNotNull($payout->disbursed_at);

        Notification::assertSentTo($this->organizer, FinalPayoutDisbursedNotification::class);
    }

    /**
     * Test webhook rejects unauthorized IP addresses.
     */
    public function test_webhook_callback_rejects_unauthorized_ip(): void
    {
        $payout = Payout::factory()->processing()->create([
            'event_id' => $this->event->id,
            'organizer_id' => $this->organizer->id,
            'payout_type' => PayoutType::Final,
            'midtrans_reference' => 'IRIS-REF-200',
        ]);

        $response = $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.1']) // Unauthorized IP
            ->postJson(route('payout.callback'), [
                'reference_no' => 'IRIS-REF-200',
                'status' => 'completed',
            ]);

        $response->assertStatus(403);
        $this->assertEquals(PayoutStatus::Processing, $payout->fresh()->status);
    }

    /**
     * Test admin can manually trigger a sync request.
     */
    public function test_admin_can_manually_sync_payout_status(): void
    {
        $payout = Payout::factory()->processing()->create([
            'event_id' => $this->event->id,
            'organizer_id' => $this->organizer->id,
            'payout_type' => PayoutType::Final,
            'midtrans_reference' => 'IRIS-REF-300',
        ]);

        Http::fake([
            'https://app.sandbox.midtrans.com/iris/api/v1/payouts/IRIS-REF-300' => Http::response([
                'reference_no' => 'IRIS-REF-300',
                'status' => 'completed',
                'amount' => '300000.00',
            ], 200),
        ]);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.payouts.sync', $payout));

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Payout status successfully synchronized with Midtrans.');

        $payout->refresh();
        $this->assertEquals(PayoutStatus::Completed, $payout->status);
    }
}
