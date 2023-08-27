<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    // Empêcher de migrer le champ timpestamps;
    public $timestamps = false;

    protected $guarded = ['id'];

    // Matérialisation de la relation un restaurant a plusieurs recettes

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    // Matérialisation de la relation un restaurant diffuse plusieurs médias

    public function medias(): HasMany
    {
        return $this->hasMany(Media::class);
    }

    // Matérialisation de la relation un restaurant a plusieurs sliders

    public function sliders(): HasMany
    {
        return $this->hasMany(Slider::class);
    }
}
