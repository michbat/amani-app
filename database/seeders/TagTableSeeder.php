<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'name' => 'Vegan',
            ],
            [
                'name' => 'Italien',
            ],
            [
                'name' => 'Light',
            ],
            [
                'name' => 'Asiatique',
            ],
            [
                'name' => 'Traditionnel',
            ],
            [
                'name' => 'Recette du chef',
            ],
            [
                'name' => 'Viande',
            ],
            [
                'name' => 'Sans gluten',
            ],
            [
                'name' => 'Économique',
            ],
            [
                'name' => 'Méditeranéen',
            ],
            [
                'name' => 'Oriental',
            ],
        ];

        Tag::insert($tags);
    }
}
