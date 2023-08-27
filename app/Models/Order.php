<?php

namespace App\Models;

use App\Models\MenuOrder;
use App\Enums\OrderStatus;
use App\Enums\PaymentMode;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'paymentMode' => PaymentMode::class,
        'paymentStatus' => PaymentStatus::class,
        'orderStatus' => OrderStatus::class,
    ];

    // Matérialisation de la relation une commande n'appartient qu'à un et un seul user (client)

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Une commande peut comporter plusieurs lignes de commande

    public function menuOrders(): HasMany
    {
        return $this->hasMany(MenuOrder::class);
    }
}
