<?php

namespace App\Providers;


use App\Models\Restaurant;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

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

        // Lors de l'édition d'un produit, nous devons vérifier si la quantité en stock est strictement supérieur au seuil de quantité minimale.

        Validator::extend('greater_than_minimum', function ($attribute, $value, $parameters, $validator) {
            $minimumField = $parameters[0];
            $minimumValue = $validator->getData()[$minimumField];
            return $value > $minimumValue;
        });
    }
}
