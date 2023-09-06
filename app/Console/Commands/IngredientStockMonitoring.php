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

        foreach ($ingredients as $ingredient) {
            if ($ingredient->quantityInStock <= $ingredient->quantityMinimum) {
                $ingredient->stockStatus = StockStatus::NOTAVAILABLE->value;
                $ingredient->update();

                foreach ($ingredient->menus as $menu) {
                    $menu->available = 0; // Set to false when ingredient is not available
                    $menu->save();

                    info('Menu ' . $menu->name . ' is now unavailable.');
                }
            }
        }

    }
}
