<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Drink;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DrinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cat_vin_id = Category::where('designation', 'Vins')->first()->id;
        $cat_soft_id = Category::where('designation', 'Softs')->first()->id;
        $cat_eau_id = Category::where('designation', 'Eaux')->first()->id;
        $cat_biere_id = Category::where('designation', 'Bières')->first()->id;
        $drinks = [

            // Les vins

            [
                'category_id' => $cat_vin_id,
                'name' => 'Château de Paillet Quancard',
                'slug' => Str::slug('Château de Paillet Quancard', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/1-paillet_quancard.png',
                'price' => 11.50,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_vin_id,
                'name' => 'Montcharme',
                'slug' => Str::slug('Montcharme', '-'),
                'description' =>"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/2-montcharmerg.png',
                'price' => 11.75,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_vin_id,
                'name' => 'Maison Barboulot',
                'slug' => Str::slug('Maison Barboulot', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/3-barboulotnew.png',
                'price' => 8.75,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_vin_id,
                'name' => 'Tenuta Le Colonne',
                'slug' => Str::slug('Tenuta Le Colonne', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/4-colonnebl.png',
                'price' => 13.75,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],

            // Bières

            [
                'category_id' => $cat_biere_id,
                'name' => 'Grosse Bertha ',
                'slug' => Str::slug('Grosse Bertha', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/5-biere-grosse-bertha.jpg',
                'price' => 3.75,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_biere_id,
                'name' => 'Saison Dupont',
                'slug' => Str::slug('Saison Dupont', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/6-biere-saison-dupont.jpg',
                'price' => 2.00,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_biere_id,
                'name' => 'Chimay Dorée',
                'slug' => Str::slug('Chimay dorée', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/7-biere-chimay-doree.jpg',
                'price' => 2.50,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_biere_id,
                'name' => 'Trappistes Rochefort',
                'slug' => Str::slug('Trappistes Rochefort', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/8-biere-rochefort.jpg',
                'price' => 2.75,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_biere_id,
                'name' => 'Chimay Bleue',
                'slug' => Str::slug('Chimay Bleue', '-'),
                'description' =>"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/9-biere-chimay-bleue.jpg',
                'price' => 5.75,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_biere_id,
                'name' => 'Westmalle Tripel',
                'slug' => Str::slug('Westmalle Tripel', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/10-biere-westmalle-tripel.jpg',
                'price' => 3.00,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_biere_id,
                'name' => 'Guldenberg',
                'slug' => Str::slug('Guldenberg', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/11-biere-guldenberg-de-ranke.jpg',
                'price' => 5.50,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_biere_id,
                'name' => 'Moinette Biologique',
                'slug' => Str::slug('Moinette Biologique', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/12-biere-moinette-biologique.jpg',
                'price' => 7.50,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],

            // Softs

            [
                'category_id' => $cat_soft_id,
                'name' => 'Coca Cola',
                'slug' => Str::slug('Coca Cola', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/13-coca-cola.jpg',
                'price' => 2.50,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_soft_id,
                'name' => 'Fanta',
                'slug' => Str::slug('Fanta', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/14-fanta.jpeg',
                'price' => 2.50,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_soft_id,
                'name' => 'Minute Maid',
                'slug' => Str::slug('Minute Maid', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/15-minute-maid.jpg',
                'price' => 3.50,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_soft_id,
                'name' => 'Sprite',
                'slug' => Str::slug('Sprite', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/16-sprite.jpeg',
                'price' => 2.50,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_soft_id,
                'name' => 'Schweppes',
                'slug' => Str::slug('Schweppes', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/17-schweppes.jpg',
                'price' => 2.50,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],

            // Eaux

            [
                'category_id' => $cat_eau_id,
                'name' => 'Spa',
                'slug' => Str::slug('Spa', '-'),
                'description' =>"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/18-spa.jpg',
                'price' => 3.00,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_eau_id,
                'name' => 'San Pellegrino',
                'slug' => Str::slug('San Pellegrino', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/20-san-pellegrino.jpg',
                'price' => 5.50,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_eau_id,
                'name' => 'Badoit',
                'slug' => Str::slug('Badoit', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/drink/21-badoit.jpg',
                'price' => 5.25,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 10,

            ],
        ];

        Drink::insert($drinks);
    }
}
