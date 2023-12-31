<?php

namespace App\Models;

use App\Models\Plat;
use App\Models\Drink;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LineOrders extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'line_order';
    public $timestamps = false;



    public function plat(): BelongsTo
    {
        return $this->belongsTo(Plat::class);
    }

    public function drink(): BelongsTo
    {
        return $this->belongsTo(Drink::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
