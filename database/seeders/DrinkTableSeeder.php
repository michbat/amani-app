<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Drink;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DrinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cat_vin_id = Category::where('designation', 'Vins')->first()->id;
        $cat_soft_id = Category::where('designation', 'Softs')->first()->id;
        $cat_eau_id = Category::where('designation', 'Eaux')->first()->id;
        $cat_biere_id = Category::where('designation', 'Bières')->first()->id;
        $drinks = [

            // Les vins

            [
                'category_id' => $cat_vin_id,
                'name' => 'Château de Paillet Quancard',
                'slug' => Str::slug('Château de Paillet Quancard', '-'),
                'description' => "Le Château de Paillet Quancard incarne l'excellence bordelaise, offrant un vin rouge équilibré aux arômes riches de fruits rouges et d'épices. Sa structure soyeuse et sa longueur en bouche en font un choix idéal pour les connaisseurs en quête d'une expérience gustative authentique. Découvrez le charme intemporel de ce vin prestigieux.",
                'image' => '/uploads/seeders/drink/1-paillet_quancard.png',
                'price' => 11.50,
                'available' => 1,
                'quantityInStock' => 30,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_vin_id,
                'name' => 'Montcharme',
                'slug' => Str::slug('Montcharme', '-'),
                'description' => "Le Montcharme est un vin rouge captivant, dévoilant une profondeur aromatique avec des nuances de fruits noirs et d'épices. Sa texture veloutée et son caractère équilibré en font une délicieuse option pour ceux en quête d'un vin rouge élégant et séduisant. Découvrez le charme irrésistible du Montcharme.",
                'image' => '/uploads/seeders/drink/2-montcharmerg.png',
                'price' => 11.75,
                'available' => 1,
                'quantityInStock' => 30,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_vin_id,
                'name' => 'Maison Barboulot',
                'slug' => Str::slug('Maison Barboulot', '-'),
                'description' => "Le Maison Barboulot est un vin blanc rafraîchissant qui enchante les papilles avec ses notes vibrantes d'agrumes et de fruits à chair blanche. Son caractère vif et sa finale élégante en font le compagnon idéal pour sublimer vos instants de détente et de convivialité. Plongez dans l'univers délicat du Maison Barboulot.",
                'image' => '/uploads/seeders/drink/3-barboulotnew.png',
                'price' => 8.75,
                'available' => 1,
                'quantityInStock' => 30,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_vin_id,
                'name' => 'Tenuta Le Colonne',
                'slug' => Str::slug('Tenuta Le Colonne', '-'),
                'description' => "Le Tenuta Le Colonne, vin blanc de la côte toscane, charme les sens avec ses arômes ensoleillés d'agrumes et de fruits tropicaux. Sa fraîcheur vive et son élégance en font un choix exceptionnel pour accompagner vos moments de plaisir et de découverte culinaire. Laissez-vous transporter en Toscane avec chaque gorgée de Tenuta Le Colonne.",
                'image' => '/uploads/seeders/drink/4-colonnebl.png',
                'price' => 13.75,
                'available' => 1,
                'quantityInStock' => 30,
                'quantityMinimum' => 10,

            ],

            // Bières

            [
                'category_id' => $cat_biere_id,
                'name' => 'Grosse Bertha ',
                'slug' => Str::slug('Grosse Bertha', '-'),
                'description' => "La Grosse Bertha a remporté le concours BBP en 2014 parmi trois autres bières de froment. Venue directement de l'Oktoberfest vers Bruxelles et voluptueuse à souhait, elle saura vous mettre à l’aise avec sa rondeur et bonhommie comme nulle autre pareille. Prost !
                Bière Grosse Bertha est un produit de la marque Brussels Beer Project",
                'image' => '/uploads/seeders/drink/5-biere-grosse-bertha.jpg',
                'price' => 3.75,
                'available' => 1,
                'quantityInStock' => 30,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_biere_id,
                'name' => 'Saison Dupont',
                'slug' => Str::slug('Saison Dupont', '-'),
                'description' => "Aspect : blonde naturellement trouble, mousse blanche. Nez : arômes houblonnés, épicés, touche de miel. Bouche : saveurs épicées et houblonnées, final sec.
                Bière Saison Dupont est un produit de la marque Brasserie Dupont",
                'image' => '/uploads/seeders/drink/6-biere-saison-dupont.jpg',
                'price' => 2.00,
                'available' => 1,
                'quantityInStock' => 30,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_biere_id,
                'name' => 'Chimay Dorée',
                'slug' => Str::slug('Chimay dorée', '-'),
                'description' => "Peu de temps après la construction de leur brasserie trappiste en 1862, les moines de Chimay se sont mis à brasser en très petites quantités une bière digeste et légère en alcool (elle titre 4,8%) dont la palette gustative s'inscrivait dans le style de ses aînées. Elle était à l'époque réservée aux membres de la communauté monastique. Au fil du temps, cette bière surnommée 'La Dorée' a continué de vivre à l'abbaye. Elle fut par la suite proposée aux hôtes de la communauté puis aux membres du personnel travaillant pour Chimay. En dépit de sa teneur plus faible en alcool, elle reste une bière trappiste de haute fermentation dont les touches de houblon et les arômes d'épices ne manquent pas de ravir tous ceux qui la goûtent.",
                'image' => '/uploads/seeders/drink/7-biere-chimay-doree.jpg',
                'price' => 2.50,
                'available' => 1,
                'quantityInStock' => 30,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_biere_id,
                'name' => 'Trappistes Rochefort',
                'slug' => Str::slug('Trappistes Rochefort', '-'),
                'description' => "Aspect : brune légèrement voilée, mousse faible. Nez : fruité et complexe, dominé par le malt torréfié. Bouche : longue et pleine, notes de poire, anis, réglisse et banane.
                Bière Rochefort 8 est un produit de la marque Brasserie Rochefort",
                'image' => '/uploads/seeders/drink/8-biere-rochefort.jpg',
                'price' => 2.75,
                'available' => 1,
                'quantityInStock' => 30,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_biere_id,
                'name' => 'Chimay Bleue',
                'slug' => Str::slug('Chimay Bleue', '-'),
                'description' => "La bière Chimay Bleue possède une robe brune foncée et est surmontée une mousse brune. Puissante en bouche, on y distingue des arômes de torréfaction, de fruits et d'épices.
                Bière Chimay Bleue est un produit de la marque Abbaye de Chimay",
                'image' => '/uploads/seeders/drink/9-biere-chimay-bleue.jpg',
                'price' => 5.75,
                'available' => 1,
                'quantityInStock' => 30,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_biere_id,
                'name' => 'Westmalle Tripel',
                'slug' => Str::slug('Westmalle Tripel', '-'),
                'description' => "Aspect : robe ocre un peu voilée, mousse compacte. Nez : fruité et herbacé, souligné par des notes de houblon frais. Bouche : ronde, amertume marquée, notes d'agrumes, caramel, sucre candi.
                Bière Westmalle Tripel est un produit de la marque Brasserie des Trappistes Van Westmalle",
                'image' => '/uploads/seeders/drink/10-biere-westmalle-tripel.jpg',
                'price' => 3.00,
                'available' => 1,
                'quantityInStock' => 30,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_biere_id,
                'name' => 'Guldenberg',
                'slug' => Str::slug('Guldenberg', '-'),
                'description' => "Guldenberg est une bière belge d'abbaye qui marie à merveille la douceur à l'amertume. Le houblonnage à cru (dry-hopping) avec du houblon Hallertau Mittelfrüh réalisé lors de son élaboration lui donne cet arôme particulier et ce goût doux amer si distinctif.
                Pour la petite histoire, son nom lui vient de l'ancienne abbaye de Guldenberg à Wevelgem, d'où est originaire l'un des brasseurs et où l'on brassait autrefois.
                Bière Guldenberg est un produit de la marque Brasserie De Ranke",
                'image' => '/uploads/seeders/drink/11-biere-guldenberg-de-ranke.jpg',
                'price' => 5.50,
                'available' => 1,
                'quantityInStock' => 30,
                'quantityMinimum' => 10,

            ],
            [
                'category_id' => $cat_biere_id,
                'name' => 'Moinette Biologique',
                'slug' => Str::slug('Moinette Biologique', '-'),
                'description' => "La Moinette Bio est brassée par la brasserie Dupont à Tourpes en Belgique. Cette bière belge à la robe blonde trouble est surmontée d’une mousse blanche compacte et tenace. Le nez est dominé par des arômes maltés, fruités et de houblons fins. En bouche, la Moinette Bio est piquante avec une légère acidité. On peut également noter la présence de notes fruitées, de malt, de levure et de houblon. L’équilibre entre moelleux, fruité et amertume rend cette bière très désaltérante.
                Bière Moinette biologique est un produit de la marque Brasserie Dupont
                ",
                'image' => '/uploads/seeders/drink/12-biere-moinette-biologique.jpg',
                'price' => 7.50,
                'available' => 1,
                'quantityInStock' => 30,
                'quantityMinimum' => 10,

            ],

            // Softs

            [
                'category_id' => $cat_soft_id,
                'name' => 'Coca Cola',
                'slug' => Str::slug('Coca Cola', '-'),
                'description' => "Coca-Cola, la boisson emblématique au goût inimitable, allie rafraîchissement pétillant et une touche sucrée. Rafraîchissez vos papilles avec cette boisson désaltérante qui accompagne parfaitement les moments de convivialité depuis des décennies. Découvrez le goût intemporel du Coca-Cola.",
                'image' => '/uploads/seeders/drink/13-coca-cola.jpg',
                'price' => 2.50,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 20,

            ],
            [
                'category_id' => $cat_soft_id,
                'name' => 'Fanta',
                'slug' => Str::slug('Fanta', '-'),
                'description' => "Fanta, la boisson fruitée et pétillante qui éveille les sens avec ses saveurs audacieuses et sa fraîcheur effervescente. Découvrez une explosion de goûts fruités dans chaque gorgée, une invitation à la joie et à la vivacité. Plongez dans l'univers rafraîchissant du Fanta.",
                'image' => '/uploads/seeders/drink/14-fanta.jpeg',
                'price' => 2.50,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 20,

            ],
            [
                'category_id' => $cat_soft_id,
                'name' => 'Minute Maid',
                'slug' => Str::slug('Minute Maid', '-'),
                'description' => "Minute Maid, c'est le pur jus d'orange pressé qui vous offre un goût d'agrume authentique et rafraîchissant. Découvrez la fraîcheur naturelle de l'orange dans chaque gorgée, une expérience fruitée instantanée qui égaye votre journée. Savourez le naturel avec Minute Maid.",
                'image' => '/uploads/seeders/drink/15-minute-maid.jpg',
                'price' => 3.50,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 20,

            ],
            [
                'category_id' => $cat_soft_id,
                'name' => 'Sprite',
                'slug' => Str::slug('Sprite', '-'),
                'description' => "Sprite, la boisson pétillante au citron-lime qui éveille vos papilles avec sa fraîcheur acidulée et son effervescence vive. Découvrez un goût pétillant et désaltérant qui apporte une touche de légèreté à chaque moment. Rafraîchissez-vous avec Sprite.",
                'image' => '/uploads/seeders/drink/16-sprite.jpeg',
                'price' => 2.50,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 20,

            ],
            [
                'category_id' => $cat_soft_id,
                'name' => 'Schweppes',
                'slug' => Str::slug('Schweppes', '-'),
                'description' => "Schweppes Tonic, l'accompagnement parfait pour vos cocktails et rafraîchissements, allie une effervescence légère à une touche subtile d'amertume. Découvrez la tonicité exquise qui rehausse le goût de vos boissons préférées, pour une expérience pétillante et raffinée à chaque verre. Élevez vos instants de détente avec Schweppes Tonic.",
                'image' => '/uploads/seeders/drink/17-schweppes.jpg',
                'price' => 2.50,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 20,

            ],

            // Eaux

            [
                'category_id' => $cat_eau_id,
                'name' => 'Spa',
                'slug' => Str::slug('Spa', '-'),
                'description' => "Spa, l'eau de source naturelle qui vous offre une pureté cristalline et une fraîcheur inégalée. Découvrez l'essence même de la nature dans chaque gorgée, une source d'hydratation naturelle pour vous revitaliser à tout moment. Plongez dans la fraîcheur authentique de Spa.",
                'image' => '/uploads/seeders/drink/18-spa.jpg',
                'price' => 3.00,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 20,

            ],
            [
                'category_id' => $cat_eau_id,
                'name' => 'San Pellegrino',
                'slug' => Str::slug('San Pellegrino', '-'),
                'description' => "San Pellegrino, l'eau minérale italienne emblématique, vous transporte en Italie avec son effervescence vive et son goût rafraîchissant. Découvrez une expérience pétillante et élégante qui apporte une touche d'élégance à chaque repas. Savourez l'authenticité de San Pellegrino.",
                'image' => '/uploads/seeders/drink/20-san-pellegrino.jpg',
                'price' => 5.50,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 20,

            ],
            [
                'category_id' => $cat_eau_id,
                'name' => 'Badoit',
                'slug' => Str::slug('Badoit', '-'),
                'description' => "Badoit, l'eau pétillante française de renom, offre une effervescence délicate et une minéralité subtile qui rehaussent vos moments de dégustation. Découvrez le raffinement de Badoit, une eau pétillante qui apporte une touche d'élégance à chaque expérience culinaire. Élevez vos instants de plaisir avec Badoit.",
                'image' => '/uploads/seeders/drink/21-badoit.jpg',
                'price' => 5.25,
                'available' => 1,
                'quantityInStock' => 100,
                'quantityMinimum' => 20,

            ],
        ];

        Drink::insert($drinks);
    }
}
