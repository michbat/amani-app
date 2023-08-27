<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Additifs',
            ],
            [
                'name' => 'Épices',
            ],
            [
                'name' => 'Féculents',
            ],
            [
                'name' => 'Fromages',
            ],
            [
                'name' => 'Fruits',
            ],
            [
                'name' => 'Glucides',
            ],
            [
                'name' => 'Graisses',
            ],
            [
                'name' => 'Huiles',
            ],
            [
                'name' => 'Jus',
            ],
            [
                'name' => 'Laitiers',
            ],
            [
                'name' => 'Légumes',
            ],
            [
                'name' => 'Oeufs',
            ],
            [
                'name' => 'Oléagineux',
            ],
            [
                'name' => 'Poissons',
            ],
            [
                'name' => 'Viandes',
            ],

            [
                'name' => 'Vinaigres',
            ],
        ];

        Type::insert($types);
    }
}
