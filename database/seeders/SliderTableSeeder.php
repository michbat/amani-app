<?php

namespace Database\Seeders;

use App\Models\Slider;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
                'content' => 'Notre chef passionné puise son inspiration à travers le monde,créant des plats qui racontent une histoire à chaque bouchée',
                'image' => '/uploads/seeders/slider/slider-1.jpg'

            ],
            [
                'restaurant_id' => $resto_id,
                'title' => 'Profitez d\'un bon dîner entre amis',
                'content' => 'Que vous souhaitiez célébrer une occasion spéciale, partager un repas en famille ou simplement savourer des moments de convivialité entre amis, notre restaurant vous ouvre grand ses portes',
                'image' => '/uploads/seeders/slider/slider-2.jpg'

            ],
            [
                'restaurant_id' => $resto_id,
                'title' => 'Plongez dans une expérience gastronomique inoubliable',
                'content' => 'Grâce à notre menu créatif mettant en valeur des ingrédients frais et des saveurs innovantes, vous vous embarquerez pour un voyage gustatif captivant',
                'image' => '/uploads/seeders/slider/slider-3.jpg'

            ],
            [
                'restaurant_id' => $resto_id,
                'title' => 'Des spectacles de musique sympas et gratuits',
                'content' => 'Rejoignez-nous chaque samedi pour des spectacles de musique gratuits dans notre restaurant. Détendez-vous, dînez et profitez de la musique en direct sans frais supplémentaires',
                'image' => '/uploads/seeders/slider/slider-4.jpg'

            ],
        ];

        Slider::insert($sliders);
    }
}
