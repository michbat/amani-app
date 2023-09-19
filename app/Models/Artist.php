<?php

namespace App\Models;

use App\Models\Band;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Artist extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];


    // Un artiste n'appartient qu'à une et une seule bande (groupe)

    public function band(): BelongsTo
    {
        return $this->belongsTo(Band::class);
    }
}
