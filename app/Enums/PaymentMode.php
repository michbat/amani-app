<?php

namespace App\Enums;

enum PaymentMode: string {
    case CARD = 'card';
    case CASH = 'cash';
    case PAYPAL = 'paypal';

    public function label(): string
    {
        return match ($this) {
            self::CARD => 'Carte bancaire',
            self::CASH => 'Cash',
            self::PAYPAL => 'Paypal',
        };
    }
    public function color(): string
    {
        return match ($this) {
            self::CARD => 'text-dark btn btn-primary',
            self::CASH => 'text-dark btn btn-warning',
            self::PAYPAL => 'text-dark btn btn-info',
        };
    }
}
