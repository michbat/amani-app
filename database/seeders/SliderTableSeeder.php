<?php

namespace Database\Seeders;

use App\Models\Slider;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;


class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        $resto_id = Restaurant::where('name', 'Amani')->first()->id;
        $sliders = [
            [
                'restaurant_id' => $resto_id,
                'title' => 'Venez goûter une cuisine originale et raffinée',
                'content' =>   'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quibusdam odit molestiae optio dolores porro unde laborum ad sequi est',
                'image' => '/uploads/seeders/slider/slider-1.jpg'

            ],
            [
                'restaurant_id' => $resto_id,
                'title' => 'Profitez d\'un bon dîner entre amis',
                'content' =>   "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quibusdam odit molestiae optio dolores porro unde laborum ad sequi est",
                'image' => '/uploads/seeders/slider/slider-2.jpg'

            ],
            [
                'restaurant_id' => $resto_id,
                'title' => 'Plongez dans une expérience gastronomique inoubliable',
                'content' =>   "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quibusdam odit molestiae optio dolores porro unde laborum ad sequi est",
                'image' => '/uploads/seeders/slider/slider-3.jpg'

            ],
            [
                'restaurant_id' => $resto_id,
                'title' => 'Des spectacles de musique sympas et gratuits',
                'content' =>  "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque quibusdam odit molestiae optio dolores porro unde laborum ad sequi est",
                'image' => '/uploads/seeders/slider/slider-4.jpg'

            ],
        ];

        Slider::insert($sliders);
    }
}
