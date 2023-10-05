<?php

namespace App\Console\Commands;

use App\Models\Representation;
use Carbon\Carbon;
use Illuminate\Console\Command;

class representationExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'representation:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'monitoring expired representation';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //On récupière la date l'heure courantes

        $currentDate = Carbon::now('Europe/Brussels')->format('Y-m-d');
        $currentTime = Carbon::now('Europe/Brussels')->format('H:i:s');

        // Je récupère toutes les représentations

        $representations = Representation::all();


        foreach ($representations as $representation) {

            if ($representation->representationDate < $currentDate) {
                $representation->isExpired = 1;
                $representation->update();
            }

            if ($representation->representationDate == $currentDate && $representation->endTime <= $currentTime) {
                $representation->isExpired = 1;
                $representation->update();
            }
        }
    }
}
