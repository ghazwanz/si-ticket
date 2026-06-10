<?php

declare(strict_types=1);

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Models\Payout;
use App\Services\Admin\PayoutService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PayoutWebhookController extends Controller
{
    public function __construct(
        private readonly PayoutService $payoutService
    ) {}

    /**
     * Handle Midtrans Iris payout callback.
     */
    public function handleCallback(Request $request): Response
    {
        $payload = $request->all();
        Log::info('Midtrans Iris Webhook Callback Received', ['payload' => $payload]);

        // 1. Verify source IP ranges
        $ip = $request->ip();
        $allowedIps = [
            '103.208.23.',  // Midtrans sandbox/production
            '103.56.14.',   // Midtrans production
            '103.78.23.',
            '34.101.',      // GCP Jakarta (Midtrans sandbox origin)
            '127.0.0.1',    // Testing localhost
            '::1',          // Testing localhost IPv6
        ];

        $ipAllowed = false;
        foreach ($allowedIps as $allowedIp) {
            if (str_starts_with($ip, $allowedIp)) {
                $ipAllowed = true;
                break;
            }
        }

        if (! $ipAllowed) {
            Log::warning('Midtrans Iris Webhook blocked: unauthorized source IP address', ['ip' => $ip]);

            return response('Unauthorized IP address', 403);
        }

        // 2. Resolve Payout reference_no
        $referenceNo = $payload['reference_no'] ?? $payload['reference_num'] ?? '';
        if (empty($referenceNo)) {
            Log::warning('Midtrans Iris Webhook blocked: reference_no is missing');

            return response('Missing reference_no', 400);
        }

        $payout = Payout::find($referenceNo);
        if (! $payout) {
            $payout = Payout::where('midtrans_reference', $referenceNo)->first();
        }

        if (! $payout) {
            Log::error('Midtrans Iris Webhook: payout record not found', ['reference_no' => $referenceNo]);

            return response('Payout not found', 404);
        }

        // 3. Sync payout status securely from Midtrans API (Source of Truth)
        try {
            $this->payoutService->syncPayoutStatus($payout);

            return response('OK');
        } catch (\Exception $e) {
            Log::error('Midtrans Iris Webhook: sync failed', [
                'payout_id' => $payout->id,
                'message' => $e->getMessage(),
            ]);

            return response('Sync failed: '.$e->getMessage(), 500);
        }
    }
}
