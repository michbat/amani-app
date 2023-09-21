<?php

namespace App\Models;

use App\Models\Show;
use App\Models\Music;
use App\Models\Artist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Band extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];

    // Une bande peut présenter plusieurs shows

    public function shows(): HasMany
    {
        return $this->hasMany(Show::class);
    }

    // Un groupe a plusieurs artistes

    public function artists(): HasMany
    {
        return $this->hasMany(Artist::class);
    }

    // Un groupe peut jouer plusieurs styles de musique

    public function musics(): BelongsToMany
    {
        return $this->belongsToMany(Music::class);
    }

    // Méthode qui vérifie si un style de musique est affecté à un groupe

    public function hasMusic($style): bool
    {
        return $this->musics()->where('style', $style)->exists();
    }

}
