<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            [
                'name' => 'Kilogrammes',
                'symbol' => 'Kg',
            ],
            [
                'name' => 'Litres',
                'symbol' => 'L',
            ],
            [
                'name' => 'Pièces',
                'symbol' => 'PC',
            ]
        ];

        Unit::insert($units);
    }
}
