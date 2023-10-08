<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Plat;
use App\Models\Drink;
use Illuminate\Console\Command;

class PlatDrinkOrderPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'platsDrinks:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hours ordering permissions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Je récupère tous les plats et boissons en vue de les rendre indisponibles à la commande en dehors des heures d'ouverture

        $plats = Plat::all();
        $drinks = Drink::all();
        // Je récupère l'heure courante en Belgique
        $currentTime = Carbon::now('Europe/Brussels')->format('H:i');
        $openingTime = '00:00';
        $closingTime = '23:59';


        if ($currentTime >= $openingTime && $currentTime <= $closingTime) {
            // Durant les heures d'ouverture, les plats et les boissons  sont  disponibles à la commande
            foreach ($plats as $plat) {
                $plat->canBeCommended = 1;
                $plat->save();
            }
            foreach ($drinks as $drink) {
                $drink->canBeCommended = 1;
                $drink->save();
            }
        } else {
            // Sinon, ils ne sont pas disponibles à la commande

            foreach ($plats as $plat) {
                $plat->canBeCommended = 0;
                $plat->save();
            }
            foreach ($drinks as $drink) {
                $drink->canBeCommended = 0;
                $drink->save();
            }
        }
    }
}
