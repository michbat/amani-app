<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\TagTableSeeder;
use Database\Seeders\MenuTableSeeder;
use Database\Seeders\TypeTableSeeder;
use Database\Seeders\UnitTableSeeder;
use Database\Seeders\SliderTableSeeder;
use Database\Seeders\GalleryTableSeeder;
use Database\Seeders\CategoryTableSeeder;
use Database\Seeders\IngredientTableSeeder;
use Database\Seeders\RestaurantTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // UserTableSeeder::class,
            AdminSeeder::class,
            RestaurantTableSeeder::class,
            CategoryTableSeeder::class,
            MenuTableSeeder::class,
            TagTableSeeder::class,
            TypeTableSeeder::class,
            UnitTableSeeder::class,
            IngredientTableSeeder::class,
            GalleryTableSeeder::class,
            SliderTableSeeder::class,
        ]);
    }
}