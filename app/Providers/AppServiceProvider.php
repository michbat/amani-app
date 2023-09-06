<?php

namespace App\Providers;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Validator;
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
        // Obtenir la pagination Bootstrap

        Paginator::useBootstrapFour();

        // Accéder à l'objet $restaurant dans toutes les vues.

        $restaurant = Restaurant::where('name', 'Amani')->first();
        view()->share('global', $restaurant);

        // On définit une règle de validation en vue de vérifier si au moment de l'ajout d'un ingredient, la quantité ajoutée en stock est 3X supérieure à la quantité ajouté dans le stock minimum

        Validator::extend('stock_check', function ($attribute, $value, $parameters, $validator) {
            $quantityInStock = $validator->getData()['quantityInStock'];
            return $quantityInStock >= 3 * $value;
        });
    }
}
