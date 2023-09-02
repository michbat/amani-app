<?php

namespace App\Console;

use DateTimeZone;
use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Order;
use App\Enums\OrderStatus;
use App\Events\OrderPendingEvent;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            $orders = Order::where('orderStatus', OrderStatus::CONFIRMED->value)->where('created_at', '<=', Carbon::now()->subMinutes(2))->get();

            if (count($orders) > 0) {
                foreach ($orders as $order) {
                    $order->orderStatus = OrderStatus::PENDING->value;
                    $user = $order->user;
                    event(new OrderPendingEvent($user));
                    $order->update();
                }
            }
        })->everyFiveSeconds();


        $schedule->call(function () {
            $menus = Menu::all();
            $currentTime = Carbon::now('Europe/Brussels')->format('H:i');
            $openKitchenTime = '20:35';
            $closeKitchenTime = '23:30';


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
        })->everyFiveSeconds();
    }


    /**
     * Get the timezone that should be used by default for scheduled events.
     */
    protected function scheduleTimezone(): DateTimeZone|string|null
    {
        return 'Europe/Brussels';
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
