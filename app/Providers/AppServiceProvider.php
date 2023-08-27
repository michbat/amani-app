<?php

namespace App\Providers;

use App\Models\Restaurant;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        // Accéder à l'objet $restaurant dans toutes les vues.

        $restaurant = Restaurant::where('name', 'Amani')->first();
        view()->share('global', $restaurant);
    }
}
