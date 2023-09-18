<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Review;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\LineOrders;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Matérialisation de la relation un plat ne peut qu'appartenir qu' à une et une seule catégorie

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    // Matérialisation de la relation un plat n'appartient qu'à notre restaurant

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    // Matérialisation de la relation un plat peut avoir plusieurs tags

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    // Méthode qui vérifie si un tag est affecté à un plat

    public function hasTag($name): bool
    {
        return $this->tags()->where('name', $name)->exists();
    }

    // Matérialisation de la relation un ingrédient peut entrer dans la composition de plusieurs plats

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class)->withPivot('amount');
    }

    // Un plat peut être concerné par plusieurs commandes

    public function lineOrders(): HasMany
    {
        return $this->hasMany(LineOrders::class);
    }

    // Un plat peut faire l'objet de plusieurs commentaires

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
