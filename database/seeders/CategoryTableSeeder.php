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
                'description' => 'Explorez nos délicieuses entrées : bruschettas méditerranéennes, rouleaux de printemps frais, plateaux de fromages raffinés. Des saveurs audacieuses ou classiques pour un début de repas mémorable. Plongez dans une aventure culinaire dès la première bouchée.',
                'image' => '/uploads/category/entree.jpg',

            ],
            [
                'designation' => 'Plats principaux',
                'description' => 'Découvrez nos plats principaux qui captiveront vos sens : tendre saumon rôti, filet de bœuf juteux, et risotto crémeux aux champignons. Une symphonie de goûts pour satisfaire vos envies culinaires les plus exigeantes. Laissez-vous emporter par une expérience gastronomique exceptionnelle.',
                'image' => '/uploads/category/plat_principal.jpg',

            ],
            [
                'designation' => 'Desserts',
                'description' => 'Laissez-vous tenter par nos desserts exquis : fondant au chocolat fondant, tarte aux fruits fraîchement cueillis et crème brûlée onctueuse. Une touche sucrée parfaite pour conclure votre repas en beauté. Succombez à la tentation et savourez chaque dernier instant.',
                'image' => '/uploads/category/dessert.jpg',

            ],
            [
                'designation' => 'Boissons',
                'description' => 'Rafraîchissez-vous avec nos boissons artisanales : des cocktails uniques préparés avec soin, une sélection de vins raffinés et des boissons non-alcoolisées créatives. Laissez nos boissons accompagner parfaitement chaque instant de votre repas. Élevez votre expérience culinaire avec chaque gorgée.',
                'image' => '/uploads/category/boisson.jpg',

            ],
        ];

        Category::insert($categories);
    }
}
