<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    // Désactivation du champ $timestamps qui s'ajoute automatiquement à la table lors de sa migration.

    public $timestamps = false;

    protected $guarded = ['id'];

    // Matérialisation de la relation many to many (Un tag peut-être attribué à plusieurs recettes)

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class);
    }
}
