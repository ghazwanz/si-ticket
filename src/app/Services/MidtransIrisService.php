<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\PayoutType;
use App\Models\Payout;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class MidtransIrisService
{
    private string $serverKey;

    private bool $isProduction;

    private string $baseUrl;

    public function __construct()
    {
        $this->serverKey = config('services.midtrans.iris_api_key', '');
        $this->isProduction = (bool) config('services.midtrans.is_production', false);
        $this->baseUrl = $this->isProduction
            ? 'https://app.midtrans.com/iris/api/v1'
            : 'https://app.sandbox.midtrans.com/iris/api/v1';
    }

    /**
     * Create a payout request in Midtrans Iris.
     *
     * @throws \Exception
     */
    public function createPayout(Payout $payout): array
    {
        $bankCode = $this->normalizeBankCode($payout->payout_bank_name ?? '');
        $amount = (string) $payout->net_amount;

        // If it's an advance payout, use approved_amount instead of net_amount
        if ($payout->payout_type === PayoutType::Advance || $payout->payout_type === 'advance') {
            $amount = (string) $payout->approved_amount;
        }

        $payload = [
            'payouts' => [
                [
                    'beneficiary_name' => $payout->payout_account_holder ?? $payout->organizer->name,
                    'beneficiary_account' => $payout->payout_account_number,
                    'bank' => $bankCode,
                    'amount' => $amount,
                    'notes' => 'Payout untuk Acara: '.($payout->event->name ?? 'SiTiket'),
                    'reference_no' => $payout->id,
                ],
            ],
        ];

        Log::info('Midtrans Iris: Dispatching payout request', [
            'payout_id' => $payout->id,
            'payload' => $payload,
        ]);

        $response = Http::withBasicAuth($this->serverKey, '')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->post($this->baseUrl.'/payouts', $payload);

        if ($response->successful()) {
            $data = $response->json();
            Log::info('Midtrans Iris: Payout created successfully', [
                'payout_id' => $payout->id,
                'response' => $data,
            ]);

            $payoutData = $data['payouts'][0] ?? null;
            if (! $payoutData) {
                throw new \Exception('Response Midtrans Iris tidak valid.');
            }

            return $payoutData;
        }

        Log::error('Midtrans Iris: Payout creation failed', [
            'payout_id' => $payout->id,
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        $errorMsg = $response->json('message') ?? 'Gagal membuat payout di Midtrans Iris.';
        throw new \Exception($errorMsg);
    }

    /**
     * Get payout status from Midtrans Iris.
     *
     * @throws \Exception
     */
    public function getPayoutStatus(string $referenceNo): array
    {
        $response = Http::withBasicAuth($this->serverKey, '')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->get($this->baseUrl.'/payouts/'.$referenceNo);

        if ($response->successful()) {
            return $response->json();
        }

        Log::error('Midtrans Iris: Get payout status failed', [
            'reference_no' => $referenceNo,
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        $errorMsg = $response->json('message') ?? 'Gagal mengambil status payout dari Midtrans Iris.';
        throw new \Exception($errorMsg);
    }

    /**
     * Normalize free-text bank name to Midtrans Iris bank code.
     *
     * @throws InvalidArgumentException
     */
    public function normalizeBankCode(string $bankName): string
    {
        $clean = preg_replace('/[^a-z0-9]/', '', strtolower($bankName));

        if (empty($clean)) {
            throw new InvalidArgumentException('Nama bank tidak boleh kosong.');
        }

        // Mapping common Indonesian bank names to standard Iris codes
        $mapping = [
            'bca' => 'bca',
            'bankcentralasia' => 'bca',
            'mandiri' => 'mandiri',
            'bankmandiri' => 'mandiri',
            'bni' => 'bni',
            'banknegaraindonesia' => 'bni',
            'bri' => 'bri',
            'bankrakyatindonesia' => 'bri',
            'cimb' => 'cimb',
            'cimbniaga' => 'cimb',
            'permata' => 'permata',
            'bankpermata' => 'permata',
            'danamon' => 'danamon',
            'bankdanamon' => 'danamon',
            'btn' => 'btn',
            'banktabungannegara' => 'btn',
            'bsi' => 'bsi',
            'banksyariahindonesia' => 'bsi',
        ];

        foreach ($mapping as $key => $code) {
            if (str_contains($clean, $key)) {
                return $code;
            }
        }

        // If not in standard mapping, we fall back to the cleaned alphanumeric string
        // under the assumption it might be a valid code not listed in mapping.
        // We will validate length to prevent passing garbage to Midtrans.
        if (strlen($clean) >= 2 && strlen($clean) <= 15) {
            return $clean;
        }

        throw new InvalidArgumentException("Nama bank '{$bankName}' tidak didukung oleh Midtrans Iris.");
    }
}
