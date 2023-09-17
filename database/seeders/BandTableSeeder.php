<?php

namespace Database\Seeders;

use App\Models\Band;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bands = [
            [
                'name' => 'Cool and Gang',
                'member' => 5,
            ],
            [
                'name' => 'Jah Bless',
                'member' => 5,
            ],
            [
                'name' => 'Vener Amazones',
                'member' => 4,
            ],
            [
                'name' => 'Young Leaders',
                'member' => 5,
            ],
            [
                'name' => 'Alegria',
                'member' => 6,
            ],
            [
                'name' => 'Dream Team',
                'member' => 6,

            ],
            [
                'name' => 'Alabama Mood',
                'member' => 8,
            ],
            [
                'name' => 'Majestic',
                'member' => 3
            ]


        ];

        Band::insert($bands);
    }
}
