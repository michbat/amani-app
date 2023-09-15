<?php

namespace Database\Seeders;

use App\Models\Table;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurant_id = Restaurant::all()[0]->id;

        $tables = [
            [
                'restaurant_id' => $restaurant_id,
                'code' => 'TABLE-001',
                'seat' => 5,
                'isFree' => 1,
            ],
            [
                'restaurant_id' => $restaurant_id,
                'code' => 'TABLE-002',
                'seat' => 5,
                'isFree' => 1,
            ],
            [
                'restaurant_id' => $restaurant_id,
                'code' => 'TABLE-003',
                'seat' => 5,
                'isFree' => 1,
            ],
            [
                'restaurant_id' => $restaurant_id,
                'code' => 'TABLE-004',
                'seat' => 5,
                'isFree' => 1,
            ],
            [
                'restaurant_id' => $restaurant_id,
                'code' => 'TABLE-005',
                'seat' => 5,
                'isFree' => 1,
            ],
            [
                'restaurant_id' => $restaurant_id,
                'code' => 'TABLE-006',
                'seat' => 5,
                'isFree' => 1,
            ],
            [
                'restaurant_id' => $restaurant_id,
                'code' => 'TABLE-007',
                'seat' => 5,
                'isFree' => 1,
            ],
            [
                'restaurant_id' => $restaurant_id,
                'code' => 'TABLE-008',
                'seat' => 5,
                'isFree' => 1,
            ],
            [
                'restaurant_id' => $restaurant_id,
                'code' => 'TABLE-009',
                'seat' => 5,
                'isFree' => 1,
            ],
            [
                'restaurant_id' => $restaurant_id,
                'code' => 'TABLE-0010',
                'seat' => 5,
                'isFree' => 1,
            ],
        ];

        Table::insert($tables);
    }
}
