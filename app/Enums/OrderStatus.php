<?php

namespace App\Enums;

enum OrderStatus: string
{
    case CONFIRMED = 'confirmed';
    case CANCELED = 'canceled';
    case COMPLETED = 'completed';
    case PENDING = 'pending';
    case PICKEDUP = 'pickedup';

    public function label(): string
    {
        return match ($this) {
            self::CONFIRMED => 'Confirmée',
            self::CANCELED => 'Annulée',
            self::COMPLETED => 'Prête',
            self::PENDING => 'En préparation',
            self::PICKEDUP => 'Récupérée'
        };
    }
    
    public function color(): string
    {
        return match ($this) {
            self::CONFIRMED => 'text-dark btn btn-primary',
            self::CANCELED => 'text-dark btn btn-danger',
            self::COMPLETED => 'text-dark btn btn-warning',
            self::PENDING => 'text-dark btn btn-info',
            self::PICKEDUP => 'text-dark btn btn-success',
        };
    }
}
