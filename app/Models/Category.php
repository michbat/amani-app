<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    // Désactivation du champ $timestamps qui s'ajoute à la table lors de sa migration.

    public $timestamps = false;

    protected $guarded = ['id'];

    // La matérialisation de la relation, une catégorie peut référencer un ou plusieurs menus.

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

}
