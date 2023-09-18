<?php

namespace Database\Seeders;

use App\Enums\StockStatus;
use App\Models\Ingredient;
use App\Models\Type;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class IngredientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = [

            [
                'type_id' => Type::where('name', 'Épices')->first()->id,
                'name' => 'Sel',
                'quantityInStock' => 30,
                'quantityMinimum' => 3,
                'unit_id' => Unit::where('name', 'Kilogrammes')->first()->id,
                'stockStatus' => 'available'

            ],
            [
                'type_id' => Type::where('name', 'Épices')->first()->id,
                'name' => 'Poivre',
                'quantityInStock' => 30,
                'quantityMinimum' => 3,
                'unit_id' => Unit::where('name', 'Kilogrammes')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Épices')->first()->id,
                'name' => 'Romarin',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Pièces')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Épices')->first()->id,
                'name' => 'Coriandre',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Pièces')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Épices')->first()->id,
                'name' => 'Thym',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Pièces')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Épices')->first()->id,
                'name' => 'Laurier',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Pièces')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Épices')->first()->id,
                'name' => 'Persil',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Pièces')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Épices')->first()->id,
                'name' => 'Moutarde',
                'quantityInStock' => 30,
                'quantityMinimum' => 3,
                'unit_id' => Unit::where('name', 'Kilogrammes')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],

            [
                'type_id' => Type::where('name', 'Fruits')->first()->id,
                'name' => 'Avocat',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Pièces')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Fruits')->first()->id,
                'name' => 'Citron',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Pièces')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Fruits')->first()->id,
                'name' => 'Olive rouge',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Kilogrammes')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Glucides')->first()->id,
                'name' => 'Sucre',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Kilogrammes')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Légumes')->first()->id,
                'name' => 'Tomate',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Pièces')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Légumes')->first()->id,
                'name' => 'Ail',
                'quantityInStock' => 10,
                'quantityMinimum' => 1,
                'unit_id' => Unit::where('name', 'Kilogrammes')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Légumes')->first()->id,
                'name' => 'Oignon',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Pièces')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Légumes')->first()->id,
                'name' => 'Piment doux',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Pièces')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Légumes')->first()->id,
                'name' => 'Poivron rouge',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Pièces')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Légumes')->first()->id,
                'name' => 'Poivron vert',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Pièces')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Légumes')->first()->id,
                'name' => 'Courgette',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Pièces')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Légumes')->first()->id,
                'name' => 'Salade verte',
                'quantityInStock' => 50,
                'quantityMinimum' => 5,
                'unit_id' => Unit::where('name', 'Kilogrammes')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Légumes')->first()->id,
                'name' => 'Concombre',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Pièces')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Légumes')->first()->id,
                'name' => 'Tomate cérise',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Kilogrammes')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Légumes')->first()->id,
                'name' => 'Ciboulette',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Pièces')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Huiles')->first()->id,
                'name' => 'Huile d\'olive',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Litres')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Jus')->first()->id,
                'name' => 'Jus de citron',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Litres')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Oeufs')->first()->id,
                'name' => 'Oeufs de poule',
                'quantityInStock' => 200,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Pièces')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Oléagineux')->first()->id,
                'name' => 'Amande',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Kilogrammes')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Poissons')->first()->id,
                'name' => 'Thon rouge',
                'quantityInStock' => 100,
                'quantityMinimum' => 10,
                'unit_id' => Unit::where('name', 'Kilogrammes')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],

            [
                'type_id' => Type::where('name', 'Vinaigres')->first()->id,
                'name' => 'Vinaigre balsamique',
                'quantityInStock' => 50,
                'quantityMinimum' => 5,
                'unit_id' => Unit::where('name', 'Litres')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],
            [
                'type_id' => Type::where('name', 'Vinaigres')->first()->id,
                'name' => 'Vinaigre de vin',
                'quantityInStock' => 50,
                'quantityMinimum' => 5,
                'unit_id' => Unit::where('name', 'Litres')->first()->id,
                'stockStatus' => StockStatus::AVAILABLE,
            ],

        ];

        Ingredient::insert($ingredients);
    }
}
