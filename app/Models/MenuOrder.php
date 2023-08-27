<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuOrder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'menu_order';
    public $timestamps = false;

    

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
