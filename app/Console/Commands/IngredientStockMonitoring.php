<?php

namespace App\Console\Commands;

use App\Models\Menu;
use App\Enums\StockStatus;
use App\Models\Ingredient;
use Illuminate\Console\Command;

class IngredientStockMonitoring extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ingredients:monitoring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monitoring our stock';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $ingredients = Ingredient::all();

        // Chaque seconde, on vérifie si chaque ingrédient est en quantité suffisante en comparant son stock courant
        // avec le seuil de quantité minimal à partir duquel le menu dans lequel l'ingrédient entre dans la composition
        // devient indisponible.

        foreach ($ingredients as $ingredient) {
            if ($ingredient->quantityInStock <= $ingredient->quantityMinimum) {
                $ingredient->stockStatus = StockStatus::NOTAVAILABLE->value;
                $ingredient->update();

                // On parcout les menus lié à cet ingrédients pour les rendre indisponibles.

                foreach ($ingredient->menus as $menu) {
                    $menu->available = 0; // on met la propriété available à false (0)
                    $menu->save();


                }
            }
        }

    }
}
