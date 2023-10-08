<?php

namespace App\Enums;

enum OrderStatus: string
{
    case CONFIRMED = 'confirmed';
    case CANCELED = 'canceled';
    case COMPLETED = 'completed';
    case PENDING = 'pending';
    case PICKEDUP = 'pickedup';
    case NOTCOLLECTED = 'notcollected';
    case INTERRUPTED='interrupted';

    public function label(): string
    {
        return match ($this) {
            self::CONFIRMED => 'Confirmée',
            self::CANCELED => 'Annulée',
            self::COMPLETED => 'Prête',
            self::PENDING => 'En préparation',
            self::PICKEDUP => 'Récupérée',
            self::NOTCOLLECTED => 'Pas récupérée',
            self::INTERRUPTED => 'Interrompue',
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
            self::NOTCOLLECTED => 'text-dark btn btn-secondary',
            self::INTERRUPTED => 'text-white btn btn-dark',
        };
    }
}
