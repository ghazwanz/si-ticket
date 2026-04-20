<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Organizer = 'organizer';
    case User = 'user';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Administrator',
            self::Organizer => 'Event Organizer',
            self::User => 'Reguler User',
        };
    }
}
