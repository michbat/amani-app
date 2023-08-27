<?php

namespace App\Models;

use App\Enums\StockStatus;
use App\Models\Recipe;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ingredient extends Model
{
    use HasFactory;

     // On empêche la migration automatique des champs timestamps
    public $timestamps = false;

    // Tous les champs de la table 'ingredients' peuvent faire l'objet de mass assignment sauf le champ id qui s'autoincremente.
    protected $guarderd = ['id'];

     // La prise en compte du champ 'mediatype' de type enum 'StockStatus' dans le modèle 'Ingredient'
    protected $casts = [
        'stockStatus' => StockStatus::class,
    ];

    // Matérialisation de la relation un ingrédient a un et un seul type

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    // Matérialisation de la relation un ingrédient a une et une seule unité de mesure

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    // Matérialisation de la relation un ingredient peut entrer dans la composition de plusieurs recettes

    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
    }

}
