<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Menu;
use Illuminate\Console\Command;

class MenuOrderPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menus:order';

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
        $currentTime = Carbon::now('Europe/Brussels')->format('H:i');
        $openKitchenTime = '00:00';
        $closeKitchenTime = '22:00';


        if ($currentTime >= $openKitchenTime && $currentTime <= $closeKitchenTime) {
            foreach ($menus as $menu) {
                $menu->canBeCommended = 1;
                $menu->update();
            }
        } else {
            foreach ($menus as $menu) {
                $menu->canBeCommended = 0;
                $menu->update();
            }
        }
    }
}
