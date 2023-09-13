<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Drink;
use Illuminate\Console\Command;

class MenuDrinkOrderPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menusDrinks:order';

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
        $menus = Menu::all();
        $drinks = Drink::all();
        $currentTime = Carbon::now('Europe/Brussels')->format('H:i');
        $openKitchenTime = '10:00';
        $closeKitchenTime = '23:00';


        if ($currentTime >= $openKitchenTime && $currentTime <= $closeKitchenTime) {
            foreach ($menus as $menu) {
                $menu->canBeCommended = 1;
                $menu->update();
            }
            foreach($drinks as $drink)
            {
                $drink->canBeCommended = 1;
                $drink->update();
            }
        } else {
            foreach ($menus as $menu) {
                $menu->canBeCommended = 0;
                $menu->update();
            }
            foreach($drinks as $drink)
            {
                $drink->canBeCommended = 0;
                $drink->update();
            }
        }
    }
}
