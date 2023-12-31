<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Role;
use App\Models\Order;
use App\Models\Review;
use App\Enums\UserStatus;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Désactivation du champ $timestamps qui s'ajoute à la table lors de sa migration.

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => UserStatus::class,
    ];

    /**
     *
     */

    // Matérialisation de la relation un utilisateur ne peut qu'avoir un et un seul rôle

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    // Matérialisation de la relation, un user (client) a plusieurs commandes

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    // Matérialisation de la relation, un utilisateur a plusieurs critiques

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // Méthode hasRole($name) est utilisée par notre middleware pour vérifier si un utilisateur a droit d'accéder à une route ou pas en fonction du nom son rôle

    public function hasRole($name): bool
    {
        // Vérifie si le rôle lié à l'utilisateur authentifié correspond au rôle mis en paramètre dans le middleware

        return $this->role()->where('name', $name)->exists();
    }

}
