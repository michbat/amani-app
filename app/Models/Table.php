<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Table extends Model
{
    use HasFactory;

    public $timestamps =  false;
    protected $guarded = ['id'];

    // Matérialisation de la relation une table appartient à un et un seul restaurant (le nôtre)

    public function restaurant():BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

}
