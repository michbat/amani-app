<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case DUE = 'due';
    case PAID = 'paid';

    public function label(): string
    {
        return match ($this) {
            self::DUE => 'Pas payé',
            self::PAID => 'Payé',
        };
    }
    public function color(): string
    {
        return match ($this) {
            self::DUE => 'text-dark btn btn-danger',
            self::PAID => 'text-dark btn btn-success',
        };
    }
}
