<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'user_id',
        'kode_order',
        'nama_event',
        'tanggal',
        'gambar',
        'total',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'total'   => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}