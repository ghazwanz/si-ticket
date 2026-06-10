<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Payout;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class PayoutService
{
    /**
     * Get a paginated list of payouts with filters, search, and sorting.
     */
    public function getPaginatedPayouts(array $filters): LengthAwarePaginator
    {
        $status = $filters['status'] ?? null;
        $search = $filters['search'] ?? null;
        $sort = $filters['sort'] ?? 'created_at';
        $order = $filters['order'] ?? 'desc';

        return Payout::with(['event', 'organizer.organizerProfile'])
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('event', function ($eq) use ($search) {
                        $eq->where('name', 'like', "%{$search}%");
                    })
                        ->orWhereHas('organizer', function ($oq) use ($search) {
                            $oq->where('name', 'like', "%{$search}%")
                                ->orWhereHas('organizerProfile', function ($opq) use ($search) {
                                    $opq->where('organization_name', 'like', "%{$search}%");
                                });
                        });
                });
            })
            ->when(in_array($sort, ['gross_amount', 'net_amount', 'status', 'created_at']), function ($query) use ($sort, $order) {
                return $query->orderBy($sort, $order === 'asc' ? 'asc' : 'desc');
            }, function ($query) {
                return $query->latest();
            })
            ->paginate(15)
            ->withQueryString();
    }

    /**
     * Initialize payout for a completed event.
     */
    public function initializePayout(Event $event): Payout
    {
        if ($event->status !== 'completed') {
            throw new InvalidArgumentException('Payout can only be initialized for completed events.');
        }

        if ($event->payout()->exists()) {
            throw new InvalidArgumentException('A payout record already exists for this event.');
        }

        return DB::transaction(function () use ($event) {
            // Calculate Gross Revenue (Sum of all paid orders)
            $grossAmount = $event->orders()->where('status', 'paid')->sum('total_amount');

            // Default platform fee percentage
            $feePercentage = 5.00;
            $platformFee = (int) round($grossAmount * ($feePercentage / 100));
            $netAmount = $grossAmount - $platformFee;

            // Snapshot Organizer's Bank Details
            $organizerProfile = $event->organizer->organizerProfile;
            $missingBankDetails = empty($organizerProfile?->bank_name) || empty($organizerProfile?->bank_account_number);

            return Payout::create([
                'event_id' => $event->id,
                'organizer_id' => $event->organizer_id,
                'gross_amount' => $grossAmount,
                'platform_fee' => $platformFee,
                'net_amount' => $netAmount,
                'fee_percentage' => $feePercentage,
                'payout_bank_name' => $organizerProfile?->bank_name,
                'payout_account_number' => $organizerProfile?->bank_account_number,
                'payout_account_holder' => $organizerProfile?->bank_account_name,
                'missing_bank_details' => $missingBankDetails,
                'status' => 'pending',
            ]);
        });
    }

    /**
     * Step 1: Approve for Disbursement.
     */
    public function approvePayout(Payout $payout, User $admin): Payout
    {
        if ($payout->status !== 'pending') {
            throw new InvalidArgumentException('Only pending payouts can be approved.');
        }

        if ($payout->missing_bank_details) {
            throw new InvalidArgumentException('Cannot approve payout with missing bank details.');
        }

        $payout->update([
            'status' => 'processing',
            'reviewed_by' => $admin->id,
            'reviewed_at' => now(),
        ]);

        return $payout;
    }

    /**
     * Step 2: Confirm Completed.
     */
    public function confirmPayout(Payout $payout, User $admin, string $reference): Payout
    {
        if ($payout->status !== 'processing') {
            throw new InvalidArgumentException('Only processing payouts can be confirmed.');
        }

        $payout->update([
            'status' => 'completed',
            'midtrans_reference' => $reference,
            'disbursed_by' => $admin->id,
            'disbursed_at' => now(),
        ]);

        return $payout;
    }
}
