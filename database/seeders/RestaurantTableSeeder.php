<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aboutUs = "Bienvenue chez Amani, un restaurant social où la paix et la gastronomie s'unissent pour créer une expérience exceptionnelle. Notre nom, signifiant 'Paix' en Swahili, symbolise notre engagement à rassembler la communauté autour d'une cuisine délicieuse et abordable. Nous nous efforçons de rendre la bonne nourriture accessible à tous, sans sacrifier la qualité. Dans un environnement chaleureux et accueillant, nous servons des plats préparés avec soin, allant des classiques revisités aux créations uniques de notre chef.

        Chez Amani, notre mission va au-delà de la cuisine. Nous sommes fiers d'être un espace de célébration de la diversité culturelle. Outre nos repas abordables, nous proposons des activités culturelles passionnantes, comme des spectacles de groupes musicaux locaux, pour enrichir la vie communautaire. Notre objectif est de créer une expérience qui nourrit à la fois le corps et l'esprit, en offrant un espace où l'art et la créativité s'épanouissent.

        Rejoignez-nous chez Amani pour vivre une expérience culinaire qui éveille les sens, un lieu où la paix et la convivialité se mêlent harmonieusement. Chaque repas que nous servons est une célébration de la nourriture, de la communauté et de l'engagement envers un avenir plus solidaire. Que vous soyez en quête d'une délicieuse cuisine abordable, d'un environnement accueillant ou d'une immersion culturelle, Amani vous ouvre ses portes pour une expérience mémorable.";
        
        $restaurant = [
            'name' => 'Amani',
            'phone' => '+32 2 345 67 90',
            'gsm' => '+32 488 888 888',
            'email' => 'amani@amani.com',
            'roadName' => 'rue de la Paix',
            'number' => '11',
            'postalCode' => '1000',
            'city' => 'Bruxelles',
            'aboutUs' => $aboutUs,
            'facebookLink' => 'https://www.facebook.com',
            'twitterLink' => 'https://www.twitter.com',
            'instagramLink' => 'https://www.twitter.com',

        ];

        Restaurant::insert($restaurant);
    }
}
