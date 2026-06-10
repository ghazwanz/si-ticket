<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Event;
use App\Models\Order;
use App\Models\OrderTicket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PesananTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test index returns orders for authenticated user.
     */
    public function test_index_returns_orders_for_authenticated_user(): void
    {
        $user = User::factory()->create(['role' => UserRole::User]);
        $otherUser = User::factory()->create(['role' => UserRole::User]);

        $order1 = Order::factory()->create(['user_id' => $user->id]);
        $order2 = Order::factory()->create(['user_id' => $otherUser->id]);

        $response = $this->actingAs($user)->get('/pesanan');

        $response->assertStatus(200);
        $response->assertViewHas('pesanan');
        $this->assertTrue($response->viewData('pesanan')->contains($order1));
        $this->assertFalse($response->viewData('pesanan')->contains($order2));
    }

    /**
     * Test index filters orders by status.
     */
    public function test_index_filters_orders_by_status(): void
    {
        $user = User::factory()->create(['role' => UserRole::User]);

        $paidOrder = Order::factory()->create([
            'user_id' => $user->id,
            'status' => 'paid',
        ]);
        $pendingOrder = Order::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($user)->get('/pesanan?status=paid');

        $response->assertStatus(200);
        $this->assertTrue($response->viewData('pesanan')->contains($paidOrder));
        $this->assertFalse($response->viewData('pesanan')->contains($pendingOrder));
    }

    /**
     * Test index searches by event name.
     */
    public function test_index_searches_by_event_name(): void
    {
        $user = User::factory()->create(['role' => UserRole::User]);

        $event1 = Event::factory()->create(['name' => 'Konser Dewa 19']);
        $event2 = Event::factory()->create(['name' => 'Seminar Pendidikan']);

        $order1 = Order::factory()->create(['user_id' => $user->id, 'event_id' => $event1->id]);
        $order2 = Order::factory()->create(['user_id' => $user->id, 'event_id' => $event2->id]);

        $response = $this->actingAs($user)->get('/pesanan?search=Dewa');

        $response->assertStatus(200);
        $this->assertTrue($response->viewData('pesanan')->contains($order1));
        $this->assertFalse($response->viewData('pesanan')->contains($order2));
    }

    /**
     * Test index searches by order ID.
     */
    public function test_index_searches_by_order_id(): void
    {
        $user = User::factory()->create(['role' => UserRole::User]);

        $order1 = Order::factory()->create(['user_id' => $user->id, 'midtrans_order_id' => 'JF-ABC123XYZ']);
        $order2 = Order::factory()->create(['user_id' => $user->id, 'midtrans_order_id' => 'JF-DEF456UVW']);

        $response = $this->actingAs($user)->get('/pesanan?search=ABC123XYZ');

        $response->assertStatus(200);
        $this->assertTrue($response->viewData('pesanan')->contains($order1));
        $this->assertFalse($response->viewData('pesanan')->contains($order2));
    }

    /**
     * Test show returns order detail with relationships.
     */
    public function test_show_returns_order_detail_with_relations(): void
    {
        $user = User::factory()->create(['role' => UserRole::User]);
        $order = Order::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get("/pesanan/{$order->id}");

        $response->assertStatus(200);
        $response->assertViewHas('pesanan');
        $this->assertEquals($order->id, $response->viewData('pesanan')->id);
    }

    /**
     * Test show denies access to other user's order.
     */
    public function test_show_denies_access_to_other_users_order(): void
    {
        $user = User::factory()->create(['role' => UserRole::User]);
        $otherUser = User::factory()->create(['role' => UserRole::User]);
        $order = Order::factory()->create(['user_id' => $otherUser->id]);

        $response = $this->actingAs($user)->get("/pesanan/{$order->id}");

        $response->assertStatus(403);
    }

    /**
     * Test show includes QR SVGs for paid orders.
     */
    public function test_show_includes_qr_svgs_for_paid_orders(): void
    {
        $user = User::factory()->create(['role' => UserRole::User]);
        $order = Order::factory()->create([
            'user_id' => $user->id,
            'status' => 'paid',
        ]);

        $ticket = OrderTicket::factory()->create([
            'order_id' => $order->id,
            'qr_token' => 'ticket-uuid-token',
        ]);

        $response = $this->actingAs($user)->get("/pesanan/{$order->id}");

        $response->assertStatus(200);
        $response->assertViewHas('ticketQrs');
        $ticketQrs = $response->viewData('ticketQrs');
        $this->assertArrayHasKey($ticket->id, $ticketQrs);
        $this->assertStringContainsString('<svg', $ticketQrs[$ticket->id]);
    }

    /**
     * Test show excludes QR for non-paid orders.
     */
    public function test_show_excludes_qr_for_non_paid_orders(): void
    {
        $user = User::factory()->create(['role' => UserRole::User]);
        $order = Order::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        $ticket = OrderTicket::factory()->create([
            'order_id' => $order->id,
            'qr_token' => 'ticket-uuid-token',
        ]);

        $response = $this->actingAs($user)->get("/pesanan/{$order->id}");

        $response->assertStatus(200);
        $response->assertViewHas('ticketQrs');
        $this->assertEmpty($response->viewData('ticketQrs'));
    }

    /**
     * Test show includes retry payment for pending with valid reservation.
     */
    public function test_show_includes_retry_payment_for_pending_with_valid_reservation(): void
    {
        $user = User::factory()->create(['role' => UserRole::User]);

        $order = Order::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'snap_token' => 'some-snap-token',
            'stock_reserved_until' => now()->addMinutes(10),
        ]);

        $response = $this->actingAs($user)->get("/pesanan/{$order->id}");

        $response->assertStatus(200);
        $response->assertViewHas('canRetryPayment', true);
    }
}
