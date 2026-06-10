<?php

namespace App\Enums;

enum PayoutStatus: string
{
    case Pending = 'pending';
    case Processing = 'processing';
    case Completed = 'completed';
    case Failed = 'failed';
    case Voided = 'voided';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Menunggu Reviu',
            self::Processing => 'Diproses',
            self::Completed => 'Selesai',
            self::Failed => 'Gagal',
            self::Voided => 'Dibatalkan',
            self::Rejected => 'Ditolak',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'text-amber-400 bg-amber-400/10',
            self::Processing => 'text-blue-400 bg-blue-400/10',
            self::Completed => 'text-emerald-400 bg-emerald-400/10',
            self::Failed => 'text-rose-400 bg-rose-400/10',
            self::Voided => 'text-slate-400 bg-slate-400/10',
            self::Rejected => 'text-rose-400 bg-rose-400/10',
        };
    }
}
