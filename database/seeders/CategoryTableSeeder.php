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
                'image' => '/uploads/seeders/category/entree.jpg',

            ],
            [
                'designation' => 'Plats principaux',
                'description' => 'Découvrez nos plats principaux qui captiveront vos sens : tendre saumon rôti, filet de bœuf juteux, et risotto crémeux aux champignons. Une symphonie de goûts pour satisfaire vos envies culinaires les plus exigeantes. Laissez-vous emporter par une expérience gastronomique exceptionnelle.',
                'image' => '/uploads/seeders/category/plat_principal.jpg',

            ],
            [
                'designation' => 'Desserts',
                'description' => 'Laissez-vous tenter par nos desserts exquis : fondant au chocolat fondant, tarte aux fruits fraîchement cueillis et crème brûlée onctueuse. Une touche sucrée parfaite pour conclure votre repas en beauté. Succombez à la tentation et savourez chaque dernier instant.',
                'image' => '/uploads/seeders/category/dessert.jpg',

            ],
            [
                'designation' => 'Vins',
                'description' => 'Explorez l\'univers des vins avec une sélection variée de cépages, terroirs, et conseils pour des dégustations inoubliables, et découvrez des accords mets-vins exquis. Éveillez vos sens à travers notre sélection œnologique.',
                'image' => '/uploads/seeders/category/vin.jpg',

            ],
            [
                'designation' => 'Softs',
                'description' => 'Explorez notre gamme de boissons non alcoolisées, regorgeant de saveurs pétillantes comme Coca-Cola, Fanta mais aussi des jus de fruits pour des moments rafraîchissants et délicieux à tout moment de la journée. Découvrez le plaisir "soft" dès maintenant !',
                'image' => '/uploads/seeders/category/soft.jpg',

            ],
            [
                'designation' => 'Eaux',
                'description' => 'Découvrez une sélection rafraîchissante d\'eaux de source, minérales et aromatisées, pour étancher votre soif et vivre une expérience hydratante incomparable. Plongez dans notre univers des eaux et faites le plein de fraîcheur.',
                'image' => '/uploads/seeders/category/eau.jpg',

            ],
            [
                'designation' => 'Bières',
                'description' => 'Découvrez une variété brassicole passionnante avec des bières artisanales, classiques et des conseils de dégustation. Plongez dans le monde de la bière pour une expérience houblonnée sans pareille.',
                'image' => '/uploads/seeders/category/biere.jpg',

            ],
        ];

        Category::insert($categories);
    }
}
