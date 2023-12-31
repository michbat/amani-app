<?php

namespace App\Console;

use DateTimeZone;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('platsDrinks:order')->everySecond()->runInBackground();
        $schedule->command('orders:process')->everyFiveSeconds()->runInBackground();
        $schedule->command('ingredientsDrinks:monitoring')->everySecond()->runInBackground();
        $schedule->command('representation:expired')->everyFiveMinutes()->runInBackground();
        $schedule->command('order:refunded')->everyTenSeconds()->runInBackground();

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
