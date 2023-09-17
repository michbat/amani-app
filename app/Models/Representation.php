<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Show;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Representation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];

    // Une représentation se déroule dans notre restaurant

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    // Une representation donné appartient à un et un seul show

    public function show(): BelongsTo
    {
        return $this->belongsTo(Show::class);
    }

    // Formattage de l'affichage de la date (d/m/Y) pour le public Belge

    public function getRepresentationDateFormat($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getNameDay($value)
    {

        setlocale(LC_TIME, 'fr_FR.utf8'); // Locale Time en français

        $day =  Carbon::parse($value)->formatLocalized('%A');

        return $day;
    }
}
