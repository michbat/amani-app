<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\MenuOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'paymentMethod' => PaymentMethod::class,
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
