<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'is_featured' => 'boolean',
        ];
    }

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class, 'category_id');
    }

    public function ticketCategories(): HasMany
    {
        return $this->hasMany(TicketCategory::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function merchandiseItems(): HasMany
    {
        return $this->hasMany(MerchandiseItem::class);
    }

    public function payout(): HasOne
    {
        return $this->hasOne(Payout::class);
    }

    public function cancellationRequests(): HasMany
    {
        return $this->hasMany(CancellationRequest::class);
    }

    public function latestCancellationRequest(): HasOne
    {
        return $this->hasOne(CancellationRequest::class)->latestOfMany();
    }
}
