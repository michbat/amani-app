<?php

namespace App\Models;

use App\Models\Band;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Show extends Model
{
    use HasFactory;

    public $timestamps =  false;

    protected $guarded = ['id'];

    // Un show est donné par un et un seul group

    public function band()
    {
        return $this->belongsTo(Band::class);
    }
}
