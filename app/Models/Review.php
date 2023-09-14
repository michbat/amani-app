<?php

namespace App\Models;

use App\Models\Plat;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    // Matérialisation de la relation un commentaire n'appartient qu'à un et un seul user

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Matérialisation de la relation un commentaire particulier ne peut concerner qu'un et un seul menu

    public function plat(): BelongsTo
    {
        return $this->belongsTo(Plat::class);
    }
}
