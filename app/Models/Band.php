<?php

namespace App\Models;

use App\Models\Show;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
