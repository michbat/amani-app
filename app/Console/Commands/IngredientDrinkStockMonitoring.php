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
         * est critique, on sélectionne tous les ingrédients et tous les boisssons
         */

        $ingredients = Ingredient::all();
        $drinks = Drink::all();

        // Chaque seconde, on vérifie si chaque ingrédient et chaque boisson sont en quantité suffisante en comparant leur stock courant
        // avec le seuil de quantité minimal à partir duquel le plat qui contient l'ingrédient et le boisson deviennent indisponibles

        foreach ($ingredients as $ingredient) {
            if (($ingredient->quantityInStock / 3) <= $ingredient->quantityMinimum) {
                $ingredient->stockStatus = StockStatus::NOTAVAILABLE->value;
                $ingredient->update();

                // On parcourt les plats lié à cet ingrédient pour les rendre indisponibles.

                foreach ($ingredient->plats as $plat) {
                    $plat->available = 0; // on met la propriété available à false (0)
                    $plat->save();
                }
            }
        }

        foreach ($drinks as $drink) {
            if (($drink->quantityInStock / 3) <= $drink->quantityMinimum) {
                $drink->available = 0;
                $drink->save();
            }
        }
    }
}
