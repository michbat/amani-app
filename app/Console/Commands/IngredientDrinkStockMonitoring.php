<?php

namespace App\Console\Commands;

use App\Models\plat;
use App\Models\Drink;
use App\Enums\StockStatus;
use App\Models\Ingredient;
use Illuminate\Console\Command;

class IngredientDrinkStockMonitoring extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ingredientsDrinks:monitoring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monitoring our drinks and ingredients stocks';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        /**
         *  Pour monitorer les stocks des boissons et des ingrédients en vue d'indisponibiliser des plats ou des boissons dont le stock
         * est critique, je sélectionne tous les ingrédients et tous les boisssons
         */

        $ingredients = Ingredient::all();
        $drinks = Drink::all();

        // Chaque seconde, je vérifie si chaque ingrédient et chaque boisson sont en quantité suffisante en comparant leur stock courant
        // avec le seuil de quantité minimale à partir duquel le plat qui contient l'ingrédient et le boisson deviennent indisponibles

        foreach ($ingredients as $ingredient) {
            // Si le 1/3 de la quantité en stock est <= au seuil de quantité minimale, l'ingrédient devient indisponible

            if (($ingredient->quantityInStock / 3) <= $ingredient->quantityMinimum) {
                $ingredient->stockStatus = StockStatus::NOTAVAILABLE->value; // On met la propriété enum "stockStatus" à "NOTAVAILABLE"
                $ingredient->update();

                // On parcourt les plats contenant cet ingrédient pour les rendre indisponibles.

                foreach ($ingredient->plats as $plat) {
                    $plat->available = 0; // on met la propriété 'available' à false (0), le plat n'est plus commandable.
                    $plat->save();
                }
            }
        }

        // On fait la même chose pour les boissons
        
        foreach ($drinks as $drink) {
            if (($drink->quantityInStock / 3) <= $drink->quantityMinimum) {
                $drink->available = 0;
                $drink->save();
            }
        }
    }
}
