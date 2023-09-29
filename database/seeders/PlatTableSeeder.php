<?php

namespace Database\Seeders;

use  Carbon\Carbon;
use App\Models\Plat;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PlatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        // On récupère les ids de catégories de plats et l'id du resto qui sont de clées étrangères dans la table "plats"

        $cat_en_id = Category::where('designation', 'Entrées')->first()->id;
        $cat_pp_id = Category::where('designation', 'Plats principaux')->first()->id;
        $cat_dsrt_id = Category::where('designation', 'Desserts')->first()->id;
        $resto_id = Restaurant::where('name', 'Amani')->first()->id;
        $plats = [

            // Les entrées

            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => 'Tomates séchées',
                'slug' => Str::slug('Tomates séchées', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam, asperiores voluptate tenetur ipsum quibusdam maxime.",
                'image' => '/uploads/seeders/recipe/1-tomates_sechees.jpg',
                'price' => 8.75,
                'available' => 1,


            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => 'Tartare tomates et avocats',
                'slug' => Str::slug('Tartare tomates et avocats', '-'),
                'description' =>"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/2-tartare_tomates_avocats.jpg',
                'price' => 7.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => 'Pico de gallo',
                'slug' => Str::slug('Pico de gallo', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/3-pico_de_gallo.jpg',
                'price' => 9.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => 'Piperade',
                'slug' => Str::slug('Piperade', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/4-piperade_au_thermomix.jpg',
                'price' => 10.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Méli mélo de légumes",
                'slug' => Str::slug('Méli mélo de légumes', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/5-meli_melo_poivrons_tomates_courgette_ail.jpg',
                'price' => 6.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Salade keto",
                'slug' => Str::slug('Salade keto', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/6-salade_keto.jpeg',
                'price' => 6.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Salade de Poulet",
                'slug' => Str::slug('Salade de Poulet', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/7-salade_poulet.jpg',
                'price' => 9.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Soupe de lentilles corail",
                'slug' => Str::slug('Soupe de lentilles corail', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/8-soupe_lentille_corail.jpeg',
                'price' => 5.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Soupe de haricots verts",
                'slug' => Str::slug('Soupe de haricots verts', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/9-soupe_haricots_verts.jpg',
                'price' => 4.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Soupe de poireaux",
                'slug' => Str::slug('Soupe de poireaux', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/10-soupe_de_poireaux.jpg',
                'price' => 4.50,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Soupe aux lentilles",
                'slug' => Str::slug('Soupe aux lentilles', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/11-soupe_aux_lentilles.jpg',
                'price' => 4.25,
                'available' => 1,

            ],

            // Plats principaux

            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Pâte carbonara",
                'slug' => Str::slug('Pâte carbonara', '-'),
                'description' =>"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/12-pate_carbonara.jpg',
                'price' => 12.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Courgettes et lardons",
                'slug' => Str::slug('Courgettes et lardons', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/13-courgettes_lardon.jpg',
                'price' => 13.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Risotto aux champignons",
                'slug' => Str::slug('Risotto aux champignons', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/14-risotto_aux_champignons.jpeg',
                'price' => 14.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Salade turque",
                'slug' => Str::slug('Salade turque', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/15-salade_turque.jpg',
                'price' => 12.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Sauté de veau aux carottes",
                'slug' => Str::slug('Sauté de veau aux carottes', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/16-saute_de_boeuf_aux_legumes_et_au-riz.png',
                'price' => 13.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Wok de légumes épicés et sauce soja",
                'slug' => Str::slug('Wok de légumes épicés et sauce soja', '-'),
                'description' =>"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/17-wok_legumes_epices_sauce_soja.jpeg',
                'price' => 12.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Polenta aux légumes",
                'slug' => Str::slug('Polenta aux légumes', '-'),
                'description' =>"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => 'uploads/seeders/recipe/18-polenta_aux_legumes.jpeg',
                'price' => 10.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Sauté de boeuf aux légumes et au riz",
                'slug' => Str::slug('Sauté de boeuf aux légumes et au riz', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/19-saute_de_boeuf_aux_carottes.jpg',
                'price' => 9.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Riz blanc à la sauce au poulet et curry",
                'slug' => Str::slug('Riz blanc à la sauce au poulet et curry', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/20-riz_blanc_sauce_au_poulet.jpeg',
                'price' => 11.75,
                'available' => 1,

            ],

            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Piperade à l’œuf",
                'slug' => Str::slug('Piperade à l’œuf', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/21-piperade_oeuf.jpg',
                'price' => 11.75,
                'available' => 1,

            ],

            // Desserts

            [
                'category_id' => $cat_dsrt_id,
                'restaurant_id' => $resto_id,
                'name' => "Glace au Kinder",
                'slug' => Str::slug('Glace au Kinder', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/22-glace-au-kinder.jpg',
                'price' => 4.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_dsrt_id,
                'restaurant_id' => $resto_id,
                'name' => "Glace aux cacahuètes",
                'slug' => Str::slug('Glace aux cacahuètes', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/23-glace-cacahuete.jpg',
                'price' => 3.50,
                'available' => 1,

            ],
            [
                'category_id' => $cat_dsrt_id,
                'restaurant_id' => $resto_id,
                'name' => "Glace aux fruits",
                'slug' => Str::slug('Glace aux fruits', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/24-glace-aux-fruits.jpg',
                'price' => 3.50,
                'available' => 1,

            ],
            [
                'category_id' => $cat_dsrt_id,
                'restaurant_id' => $resto_id,
                'name' => "Gâteau roulé au chocolat Noir",
                'slug' => Str::slug('Gâteau roulé au chocolat Noir', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/25-gateau-chocolat-noir.jpeg',
                'price' => 6.50,
                'available' => 1,

            ],
            [
                'category_id' => $cat_dsrt_id,
                'restaurant_id' => $resto_id,
                'name' => "Tartelettes feuilletées aux fruits",
                'slug' => Str::slug('Tartelettes feuilletées aux fruits', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/26-tartelettes-aux-fruits.jpeg',
                'price' => 7.50,
                'available' => 1,

            ],
            [
                'category_id' => $cat_dsrt_id,
                'restaurant_id' => $resto_id,
                'name' => "Dessert au yaourt",
                'slug' => Str::slug('Dessert au yaourt', '-'),
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta nulla quidem ducimus error laudantium adipisci laboriosam debitis deserunt tempore. Cupiditate aliquid nesciunt perspiciatis laborum porro fuga, molestias enim ipsum animi similique aspernatur tempore dolorem deserunt incidunt qui, voluptatibus eveniet voluptatum, laboriosam sunt. Saepe aperiam,",
                'image' => '/uploads/seeders/recipe/27-dessert-au-yaourt.jpg',
                'price' => 4.75,
                'available' => 1,

            ],

        ];

        $base = Carbon::now();


        // Créer des menus à une minute d'intervalle.

        foreach ($plats as $index => $plat) {
            $timeInterval = $index * 60;
            $createdAt = Carbon::parse($base)->addSeconds($timeInterval);
            $updatedAt = $createdAt;

            $menus[$index]['created_at'] = $createdAt;
            $menus[$index]['updated_at'] = $updatedAt;
        }

        Plat::insert($plats);
    }
}
