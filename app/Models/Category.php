<?php

namespace App\Models;

use App\Models\Plat;
use App\Models\Drink;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    // Désactivation du champ $timestamps qui s'ajoute à la table lors de sa migration.

    public $timestamps = false;

    protected $guarded = ['id'];

    // La matérialisation de la relation, une catégorie peut référencer plusieurs menus.

    public function plats(): HasMany
    {
        return $this->hasMany(Plat::class);
    }

    // Une catégorie peut référencer plusieurs boissons

    public function drinks(): HasMany
    {
        return $this->hasMany(Drink::class);
    }
}
