<?php

namespace Database\Seeders;

use App\Enums\GalleryType;
use App\Models\Gallery;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class GalleryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resto_id = Restaurant::where('name', 'Amani')->first()->id;
        $galleries = [
            [
                'restaurant_id' => $resto_id,
                'title' => 'Amani restaurant promotion video',
                'image' => '/uploads/seeders/gallery/video-1.jpg',
                'videoId' => 'F3zw1Gvn4Mk',
                'galleryType' => GalleryType::VIDEO->value,

            ],
            [
                'restaurant_id' => $resto_id,
                'title' => 'Coca Cola au zeste de citron',
                'image' => '/uploads/seeders/gallery/boisson-1.jpg',
                'videoId' => '',
                'galleryType' => GalleryType::PHOTO->value,

            ],
            [
                'restaurant_id' => $resto_id,
                'title' => 'Jus d\'oranges de Californie',
                'image' => '/uploads/seeders/gallery/boisson-2.jpg',
                'videoId' => '',
                'galleryType' => GalleryType::PHOTO->value,

            ],
            [
                'restaurant_id' => $resto_id,
                'title' => 'Tasse de café Arabica d\'Ethiopie',
                'image' => '/uploads/seeders/gallery/boisson-3.jpg',
                'videoId' => '',
                'galleryType' => GalleryType::PHOTO->value,

            ],
            [
                'restaurant_id' => $resto_id,
                'title' => 'Cocktail aux myrtilles du printemps',
                'image' => '/uploads/seeders/gallery/boisson-4.jpg',
                'videoId' => '',
                'galleryType' => GalleryType::PHOTO->value,

            ],
            [
                'restaurant_id' => $resto_id,
                'title' => 'Smoothies aux légumes',
                'image' => '/uploads/seeders/gallery/boisson-5.jpg',
                'videoId' => '',
                'galleryType' => GalleryType::PHOTO->value,

            ],
        ];

        Gallery::insert($galleries);
    }
}
