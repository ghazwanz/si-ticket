<?php

declare(strict_types=1);

namespace App\Enums;

enum PayoutType: string
{
    case Advance = 'advance';
    case Final = 'final';

    public function label(): string
    {
        return match ($this) {
            self::Advance => 'Uang Muka (Advance)',
            self::Final => 'Pelunasan (Final)',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Advance => 'text-violet-400 bg-violet-400/10',
            self::Final => 'text-emerald-400 bg-emerald-400/10',
        };
    }
}
