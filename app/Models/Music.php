<?php

namespace App\Models;

use App\Models\Band;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Music extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'musics';

    protected $guarded = ['id'];

    // Un style de musique peut-être joué par plusieurs groupes

    public function bands(): BelongsToMany
    {
        return $this->belongsToMany(Band::class);
    }
}
