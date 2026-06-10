<?php

namespace App\Models;

use App\Enums\PayoutStatus;
use App\Enums\PayoutType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payout extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'event_id',
        'organizer_id',
        'payout_type',
        'advance_sequence',
        'gross_amount',
        'platform_fee',
        'net_amount',
        'requested_amount',
        'approved_amount',
        'reason',
        'rejection_reason',
        'payout_bank_name',
        'payout_account_number',
        'payout_account_holder',
        'missing_bank_details',
        'manual_settlement_required',
        'reviewed_by',
        'reviewed_at',
        'disbursed_by',
        'fee_percentage',
        'status',
        'midtrans_reference',
        'disbursed_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'payout_type' => PayoutType::class,
            'status' => PayoutStatus::class,
            'gross_amount' => 'integer',
            'platform_fee' => 'integer',
            'net_amount' => 'integer',
            'requested_amount' => 'integer',
            'approved_amount' => 'integer',
            'fee_percentage' => 'decimal:2',
            'missing_bank_details' => 'boolean',
            'manual_settlement_required' => 'boolean',
            'reviewed_at' => 'datetime',
            'disbursed_at' => 'datetime',
        ];
    }

    // ──────────────────────────────────────────────
    // Relationships
    // ──────────────────────────────────────────────

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class)->withTrashed();
    }

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function disburser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'disbursed_by');
    }

    // ──────────────────────────────────────────────
    // Scopes
    // ──────────────────────────────────────────────

    /**
     * Scope to filter by payout status.
     */
    public function scopeByStatus(Builder $query, PayoutStatus $status): void
    {
        $query->where('status', $status);
    }

    /**
     * Scope to filter by type advance.
     */
    public function scopeAdvance(Builder $query): void
    {
        $query->where('payout_type', PayoutType::Advance);
    }

    /**
     * Scope to filter by type final.
     */
    public function scopeFinal(Builder $query): void
    {
        $query->where('payout_type', PayoutType::Final);
    }

    /**
     * Scope to filter by event.
     */
    public function scopeForEvent(Builder $query, string $eventId): void
    {
        $query->where('event_id', $eventId);
    }

    // ──────────────────────────────────────────────
    // Business Helpers
    // ──────────────────────────────────────────────

    /**
     * Check if this payout is an advance payout.
     */
    public function isAdvance(): bool
    {
        return $this->payout_type === PayoutType::Advance;
    }

    /**
     * Check if this payout is a final payout.
     */
    public function isFinal(): bool
    {
        return $this->payout_type === PayoutType::Final;
    }

    /**
     * Check if this payout can be reviewed (first step of 4-eyes approval).
     */
    public function canBeReviewed(): bool
    {
        return $this->status === PayoutStatus::Pending;
    }

    /**
     * Check if this payout can be rejected.
     */
    public function canBeRejected(): bool
    {
        return $this->status === PayoutStatus::Pending;
    }

    /**
     * Check if this payout can be disbursed (second step of 4-eyes approval).
     */
    public function canBeDisbursed(): bool
    {
        return $this->status === PayoutStatus::Processing;
    }
}
