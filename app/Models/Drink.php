<?php

namespace App\Models;

use App\Models\LineOrders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Drink extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    // Une boisson a une et une seule catégorie

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Une boisson peut-être concerné par plusieurs commandes

    public function lineOrders(): HasMany
    {
        return $this->hasMany(LineOrders::class);
    }
}
