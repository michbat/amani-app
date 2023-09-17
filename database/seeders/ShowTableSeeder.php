<?php

namespace Database\Seeders;

use App\Models\Show;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shows = [
            [
                'band_id' => 1,
                'title' => 'Urban Tour',
                'poster' => '/uploads/seeders/show/cool_and_gang.jpg',
                'description' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam officiis atque quasi praesentium debitis corporis iusto, dolores veritatis aut quo voluptates culpa ipsa, eos fugiat sunt, eveniet labore magni laboriosam? Praesentium laboriosam vero saepe nemo enim porro eaque maiores quae consequuntur. Facilis veniam sit ea quasi eius iste beatae illum!',
            ],
            [
                'band_id' => 2,
                'title' => 'Jah Way',
                'poster' => '/uploads/seeders/show/jah_bless.jpg',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam officiis atque quasi praesentium debitis corporis iusto, dolores veritatis aut quo voluptates culpa ipsa, eos fugiat sunt, eveniet labore magni laboriosam? Praesentium laboriosam vero saepe nemo enim porro eaque maiores quae consequuntur. Facilis veniam sit ea quasi eius iste beatae illum!',
            ],
            [
                'band_id' => 3,
                'title' => 'Acid ideas',
                'poster' => '/uploads/seeders/show/amazones_enervees.jpg',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam officiis atque quasi praesentium debitis corporis iusto, dolores veritatis aut quo voluptates culpa ipsa, eos fugiat sunt, eveniet labore magni laboriosam? Praesentium laboriosam vero saepe nemo enim porro eaque maiores quae consequuntur. Facilis veniam sit ea quasi eius iste beatae illum!',
            ],
            [
                'band_id' => 4,
                'title' => 'Introduction',
                'poster' => '/uploads/seeders/show/young_leaders.jpg',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam officiis atque quasi praesentium debitis corporis iusto, dolores veritatis aut quo voluptates culpa ipsa, eos fugiat sunt, eveniet labore magni laboriosam? Praesentium laboriosam vero saepe nemo enim porro eaque maiores quae consequuntur. Facilis veniam sit ea quasi eius iste beatae illum!',
            ],
            [
                'band_id' => 5,
                'title' => 'Good vibes',
                'poster' => '/uploads/seeders/show/alegria.jpeg',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam officiis atque quasi praesentium debitis corporis iusto, dolores veritatis aut quo voluptates culpa ipsa, eos fugiat sunt, eveniet labore magni laboriosam? Praesentium laboriosam vero saepe nemo enim porro eaque maiores quae consequuntur. Facilis veniam sit ea quasi eius iste beatae illum!',
            ],
            [
                'band_id' => 6,
                'title' => 'Fela Kuti Spirit',
                'poster' => '/uploads/seeders/show/p_five.jpg',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam officiis atque quasi praesentium debitis corporis iusto, dolores veritatis aut quo voluptates culpa ipsa, eos fugiat sunt, eveniet labore magni laboriosam? Praesentium laboriosam vero saepe nemo enim porro eaque maiores quae consequuntur. Facilis veniam sit ea quasi eius iste beatae illum!',
            ],
            [
                'band_id' => 7,
                'title' => 'Les nuits du Jazz',
                'poster' => '/uploads/seeders/show/alabama_mood.jpg',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam officiis atque quasi praesentium debitis corporis iusto, dolores veritatis aut quo voluptates culpa ipsa, eos fugiat sunt, eveniet labore magni laboriosam? Praesentium laboriosam vero saepe nemo enim porro eaque maiores quae consequuntur. Facilis veniam sit ea quasi eius iste beatae illum!',
            ],
            [
                'band_id' => 8,
                'title' => 'Nostalgie',
                'poster' => '/uploads/seeders/show/majestic.jpg',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam officiis atque quasi praesentium debitis corporis iusto, dolores veritatis aut quo voluptates culpa ipsa, eos fugiat sunt, eveniet labore magni laboriosam? Praesentium laboriosam vero saepe nemo enim porro eaque maiores quae consequuntur. Facilis veniam sit ea quasi eius iste beatae illum!',
            ],
        ];

        Show::insert($shows);
    }
}
