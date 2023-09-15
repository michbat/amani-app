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
        $plats = Plat::all();
        $drinks = Drink::all();
        $currentTime = Carbon::now('Europe/Brussels')->format('H:i');
        $openKitchenTime = '00:00';
        $closeKitchenTime = '23:00';


        if ($currentTime >= $openKitchenTime && $currentTime <= $closeKitchenTime) {
            foreach ($plats as $plat) {
                $plat->canBeCommended = 1;
                $plat->update();
            }
            foreach ($drinks as $drink) {
                $drink->canBeCommended = 1;
                $drink->update();
            }
        } else {
            foreach ($plats as $plat) {
                $plat->canBeCommended = 0;
                $plat->update();
            }
            foreach ($drinks as $drink) {
                $drink->canBeCommended = 0;
                $drink->update();
            }
        }
    }
}
