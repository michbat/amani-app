<?php

namespace App\Enums;

enum OrderStatus: string {
    case CONFIRMED = 'confirmed';
    case CANCELED = 'canceled';
    case PENDING = 'pending';
    case PICKEDUP = 'pickedup';

    public function label(): string
    {
        return match ($this) {
            self::CONFIRMED => 'confirmé',
            self::CANCELED => 'canceled',
            self::PENDING => 'pending',
            self::PICKEDUP => 'pickedup'
        };
    }
    public function color(): string
    {
        return match ($this) {
            self::CONFIRMED => 'text-dark btn btn-primary',
            self::CANCELED => 'text-dark btn btn-danger',
            self::PENDING => 'text-dark btn btn-info',
            self::PICKEDUP => 'text-dark btn btn-success',
        };
    }
}
