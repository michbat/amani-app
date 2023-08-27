<?php

namespace App\Enums;

enum PaymentStatus: string {
    case DUE = 'due';
    case PAID = 'paid';
}
