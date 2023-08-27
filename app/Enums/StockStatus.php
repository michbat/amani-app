<?php

namespace App\Enums;

enum StockStatus: string {
    case AVAILABLE = 'available';
    case NOTAVAILABLE = 'notavailable';

    public function label()
    {
        return match ($this) {
            self::AVAILABLE => 'Disponible',
            self::NOTAVAILABLE => 'Non Disponible',
        };
    }

    public function color()
    {
        return match ($this) {
            self::AVAILABLE => 'text-dark btn btn-primary',
            self::NOTAVAILABLE => 'text-dark btn btn-danger',
        };
    }
}
