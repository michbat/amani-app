<?php

namespace App\Models;

use App\Models\Plat;
use App\Models\Staff;
use App\Models\Representation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;

    // Empêcher de migrer le champ timpestamps;
    public $timestamps = false;

    protected $guarded = ['id'];

    // Matérialisation de la relation notre restaurant a plusieurs recettes

    public function plats(): HasMany
    {
        return $this->hasMany(Plat::class);
    }

    // Matérialisation de la relation notre restaurant diffuse plusieurs médias

    public function medias(): HasMany
    {
        return $this->hasMany(Media::class);
    }

    // Matérialisation de la relation notre  restaurant a plusieurs sliders

    public function sliders(): HasMany
    {
        return $this->hasMany(Slider::class);
    }

    // Matérialisation de la relation notre restaurant a plusieurs cuisiniers

    public function staffs(): HasMany
    {
        return $this->hasMany(Staff::class);
    }

    // Notre restaurant accueille plusieurs représentaions de spectacles

    public function representations(): HasMany
    {
        return $this->hasMany(Representation::class);
    }
}
