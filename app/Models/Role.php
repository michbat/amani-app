<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    // Désactivation du champ $timestamps qui s'ajoute automatiquement à la table lors de sa migration.

    public $timestamps = false;

    protected $guarded = ['id'];

    /**
     *
     */

    // Matérialisation en Laravel de la relation One to Many (un rôle peut-être affecté à plusieurs utilisateurs)

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
