<?php

namespace App\Models;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarderd = ['id'];

    // Matérialisation de la relation une unité de mesure peut concerner plusieurs ingrédients

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }
}
