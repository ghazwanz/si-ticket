<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MerchandiseVariant extends Model
{
    use HasUuids;

    protected $guarded = [];

    public function item(): BelongsTo
    {
        return $this->belongsTo(MerchandiseItem::class, 'merchandise_item_id');
    }

    public function orderMerchandise(): HasMany
    {
        return $this->hasMany(OrderMerchandise::class);
    }
}
