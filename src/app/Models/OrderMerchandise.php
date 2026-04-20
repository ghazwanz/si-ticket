<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderMerchandise extends Model
{
    use HasUuids;

    protected $table = 'order_merchandise';
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_picked_up' => 'boolean',
            'picked_up_at' => 'datetime',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function merchandiseVariant(): BelongsTo
    {
        return $this->belongsTo(MerchandiseVariant::class);
    }
}
