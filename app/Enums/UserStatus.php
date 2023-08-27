<?php

namespace App\Enums;

enum UserStatus: string {
    case ACTIVE = 'active';
    case PENDING = 'pending';

    public function label()
    {
        return match ($this) {
            self::ACTIVE => 'Activé',
            self::PENDING => 'Non Activé',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::ACTIVE => 'text-dark btn btn-primary',
            self::PENDING => 'text-dark btn btn-danger',
        };
    }
}
