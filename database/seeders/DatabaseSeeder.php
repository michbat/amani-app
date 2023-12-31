<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Music;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\TableSeeder;
use Database\Seeders\TagTableSeeder;
use Database\Seeders\BandTableSeeder;
use Database\Seeders\PlatTableSeeder;
use Database\Seeders\ShowTableSeeder;
use Database\Seeders\TypeTableSeeder;
use Database\Seeders\UnitTableSeeder;
use Database\Seeders\DrinkTableSeeder;
use Database\Seeders\MusicTableSeeder;
use Database\Seeders\StaffTableSeeder;
use Database\Seeders\ArtistTableSeeder;
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
            PlatTableSeeder::class,
            DrinkTableSeeder::class,
            TagTableSeeder::class,
            TypeTableSeeder::class,
            UnitTableSeeder::class,
            IngredientTableSeeder::class,
            GalleryTableSeeder::class,
            SliderTableSeeder::class,
            StaffTableSeeder::class,
            TableSeeder::class,
            BandTableSeeder::class,
            ShowTableSeeder::class,
            ArtistTableSeeder::class,
            MusicTableSeeder::class,
        ]);
    }
}
