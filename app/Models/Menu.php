<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Review;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\OrderLines;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Matérialisation de la relation un menu ne peut avoir qu'une et une seule catégorie

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    // Matérialisation de la relation un menu n'appartient qu'à notre restaurant

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    // Matérialisation de la relation un menu peut avoir plusieurs tags

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    // Fonction qui vérifie si un tag est affecté à un menu

    public function hasTag($name): bool
    {
        return $this->tags()->where('name', $name)->exists();
    }

    // Matérialisation de la relation un ingrédient peut entrer dans la composition de plusieurs menus

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class)->withPivot('amount');
    }

    // Un menu peut être concerné par plusieurs commandes

    public function lineOrders(): HasMany
    {
        return $this->hasMany(lineOrders::class);
    }

    // Un menu peut faire l'objet de plusieurs commentaires

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
