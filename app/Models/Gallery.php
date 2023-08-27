<?php

namespace App\Models;

use App\Enums\GalleryType;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    // On empêche la migration automatique des champs timestamps
    public $timestamps = false;

    // Tous les champs de la table 'medias' peuvent faire l'objet de mass assignment sauf le champ id qui s'autoincremente.
    protected $guarded = ['id'];

    // La prise en compte du champ 'mediatype' de type enum MediaType dans le modèle 'Ingredient'

    protected $casts = [
        'galleryType' => GalleryType::class,
    ];

    // Matérialisation de la relation un média appartient à un et un seul restaurant

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
