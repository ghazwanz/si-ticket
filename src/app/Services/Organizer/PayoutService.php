<?php

declare(strict_types=1);

namespace App\Services\Organizer;

use App\Enums\EventStatus;
use App\Enums\PayoutStatus;
use App\Enums\PayoutType;
use App\Models\Event;
use App\Models\Payout;
use App\Models\SystemSetting;
use App\Models\User;
use App\Notifications\AdvancePayoutRequestedNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use InvalidArgumentException;

class PayoutService
{
    /**
     * Request an advance payout for an event.
     */
    public function requestAdvancePayout(Event $event, int $amount, string $reason): Payout
    {
        if ($event->status !== EventStatus::Published) {
            throw new InvalidArgumentException('Advance payout can only be requested for published events.');
        }

        if ($event->isStarted()) {
            throw new InvalidArgumentException('Advance payout cannot be requested after the event has started.');
        }

        if ($event->manual_settlement_required) {
            throw new InvalidArgumentException('This event requires manual settlement and is ineligible for automated advance payouts.');
        }

        if (! $event->organizer->is_active) {
            throw new InvalidArgumentException('Organizer account is currently inactive.');
        }

        $organizerProfile = $event->organizer->organizerProfile;
        if (empty($organizerProfile?->bank_name) || empty($organizerProfile?->bank_account_number) || empty($organizerProfile?->bank_account_name)) {
            throw new InvalidArgumentException('Organizer bank details must be complete before requesting advance payout.');
        }

        $hasPaidOrders = $event->orders()->where('status', 'paid')->exists();
        if (! $hasPaidOrders) {
            throw new InvalidArgumentException('Advance payout requires at least one paid order for the event.');
        }

        $hasActiveAdvance = $event->payouts()
            ->where('payout_type', PayoutType::Advance)
            ->whereIn('status', [PayoutStatus::Pending, PayoutStatus::Processing])
            ->exists();
        if ($hasActiveAdvance) {
            throw new InvalidArgumentException('There is already a pending or processing advance payout request for this event.');
        }

        return DB::transaction(function () use ($event, $amount, $reason, $organizerProfile) {
            $summary = $this->getAdvanceSummary($event);
            if ($amount > $summary['available_advance_amount']) {
                throw new InvalidArgumentException('Requested amount exceeds the maximum available advance payout limit.');
            }

            $sequence = $event->payouts()
                ->where('payout_type', PayoutType::Advance)
                ->count() + 1;

            $payout = Payout::create([
                'event_id' => $event->id,
                'organizer_id' => $event->organizer_id,
                'payout_type' => PayoutType::Advance,
                'advance_sequence' => $sequence,
                'gross_amount' => $summary['gross_sales'],
                'platform_fee' => $summary['estimated_platform_fee'],
                'net_amount' => $summary['estimated_net_sales'],
                'requested_amount' => $amount,
                'reason' => $reason,
                'payout_bank_name' => $organizerProfile->bank_name,
                'payout_account_number' => $organizerProfile->bank_account_number,
                'payout_account_holder' => $organizerProfile->bank_account_name,
                'missing_bank_details' => false,
                'fee_percentage' => $summary['fee_percentage'],
                'status' => PayoutStatus::Pending,
            ]);

            // Notify Admins
            $admins = User::where('role', 'admin')->get();
            Notification::send($admins, new AdvancePayoutRequestedNotification($payout));

            return $payout;
        });
    }

    /**
     * Get financial and advance payout summary for an event.
     */
    public function getAdvanceSummary(Event $event): array
    {
        $feePercentage = (float) SystemSetting::get('platform_fee_percent', 5.00);
        $advanceLimitPercent = config('payouts.advance_limit_percent', 40.00);

        $grossSales = (int) $event->orders()->where('status', 'paid')->sum('total_amount');
        $estimatedPlatformFee = (int) round($grossSales * ($feePercentage / 100));
        $estimatedNetSales = $grossSales - $estimatedPlatformFee;

        $maxAdvanceTotal = (int) round($estimatedNetSales * ($advanceLimitPercent / 100));

        $completedAdvanceTotal = (int) $event->payouts()
            ->where('payout_type', PayoutType::Advance)
            ->where('status', PayoutStatus::Completed)
            ->sum('approved_amount');

        $availableAdvanceAmount = $maxAdvanceTotal - $completedAdvanceTotal;
        if ($availableAdvanceAmount < 0) {
            $availableAdvanceAmount = 0;
        }

        $latestAdvance = $event->payouts()
            ->where('payout_type', PayoutType::Advance)
            ->latest()
            ->first();

        return [
            'gross_sales' => $grossSales,
            'estimated_platform_fee' => $estimatedPlatformFee,
            'estimated_net_sales' => $estimatedNetSales,
            'max_advance_limit' => $maxAdvanceTotal,
            'completed_advance_total' => $completedAdvanceTotal,
            'available_advance_amount' => $availableAdvanceAmount,
            'fee_percentage' => $feePercentage,
            'advance_limit_percent' => $advanceLimitPercent,
            'latest_advance' => $latestAdvance,
        ];
    }

    /**
     * Automatically update and re-snapshot bank details for any pending/processing payouts of the organizer.
     */
    public function autoResnapshotBankDetails(User $organizer): void
    {
        $profile = $organizer->organizerProfile;
        if (empty($profile?->bank_name) || empty($profile?->bank_account_number) || empty($profile?->bank_account_name)) {
            return;
        }

        Payout::where('organizer_id', $organizer->id)
            ->whereIn('status', [PayoutStatus::Pending, PayoutStatus::Processing])
            ->where('missing_bank_details', true)
            ->update([
                'payout_bank_name' => $profile->bank_name,
                'payout_account_number' => $profile->bank_account_number,
                'payout_account_holder' => $profile->bank_account_name,
                'missing_bank_details' => false,
            ]);
    }
}
