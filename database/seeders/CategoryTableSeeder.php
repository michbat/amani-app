<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        $categories = [
            [
                'designation' => 'Entrées',
                'description' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ab error explicabo repudiandae minus, sint mollitia natus ipsam ipsa ipsum, est rem fugiat maxime dignissimos unde, necessitatibus hic dicta asperiores. Esse.",
                'image' => '/uploads/seeders/category/entree.jpg',

            ],
            [
                'designation' => 'Plats principaux',
                'description' =>    "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ab error explicabo repudiandae minus, sint mollitia natus ipsam ipsa ipsum, est rem fugiat maxime dignissimos unde, necessitatibus hic dicta asperiores. Esse.",
                'image' => '/uploads/seeders/category/plat_principal.jpg',

            ],
            [
                'designation' => 'Desserts',
                'description' =>    "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ab error explicabo repudiandae minus, sint mollitia natus ipsam ipsa ipsum, est rem fugiat maxime dignissimos unde, necessitatibus hic dicta asperiores. Esse.",
                'image' => '/uploads/seeders/category/dessert.jpg',

            ],
            [
                'designation' => 'Vins',
                'description' =>  "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ab error explicabo repudiandae minus, sint mollitia natus ipsam ipsa ipsum, est rem fugiat maxime dignissimos unde, necessitatibus hic dicta asperiores. Esse.",
                'image' => '/uploads/seeders/category/vin.jpg',

            ],
            [
                'designation' => 'Softs',
                'description' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ab error explicabo repudiandae minus, sint mollitia natus ipsam ipsa ipsum, est rem fugiat maxime dignissimos unde, necessitatibus hic dicta asperiores. Esse.",
                'image' => '/uploads/seeders/category/soft.jpg',

            ],
            [
                'designation' => 'Eaux',
                'description' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ab error explicabo repudiandae minus, sint mollitia natus ipsam ipsa ipsum, est rem fugiat maxime dignissimos unde, necessitatibus hic dicta asperiores. Esse.",
                'image' => '/uploads/seeders/category/eau.jpg',

            ],
            [
                'designation' => 'Bières',
                'description' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ab error explicabo repudiandae minus, sint mollitia natus ipsam ipsa ipsum, est rem fugiat maxime dignissimos unde, necessitatibus hic dicta asperiores. Esse.",
                'image' => '/uploads/seeders/category/biere.jpg',

            ],
        ];

        Category::insert($categories);
    }
}
