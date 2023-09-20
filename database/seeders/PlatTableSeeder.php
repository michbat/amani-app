<?php

namespace Database\Seeders;

use  Carbon\Carbon;
use App\Models\Plat;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PlatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // On récupère les ids de catégories de plats et l'id du resto qui sont de clées étrangères dans la table "plats"

        $cat_en_id = Category::where('designation', 'Entrées')->first()->id;
        $cat_pp_id = Category::where('designation', 'Plats principaux')->first()->id;
        $cat_dsrt_id = Category::where('designation', 'Desserts')->first()->id;
        $resto_id = Restaurant::where('name', 'Amani')->first()->id;
        $plats = [

            // Les entrées

            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => 'Tomates séchées',
                'slug' => Str::slug('Tomates séchées', '-'),
                'description' => "Nos tomates séchées, gorgées de soleil, sont une véritable invitation à la Méditerranée. Récoltées à maturité, elles sont lentement séchées pour préserver leur intensité aromatique. Leur texture tendre et leur goût sucré-salé en font l'accompagnement idéal pour nos salades fraîches ou nos plats de pâtes. Découvrez l'essence de la cuisine méditerranéenne dans chaque bouchée, une expérience gustative qui vous transportera instantanément sous le soleil radieux de la côte",
                'image' => '/uploads/seeders/recipe/1-tomates_sechees.jpg',
                'price' => 8.75,
                'available' => 1,


            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => 'Tartare tomates et avocats',
                'slug' => Str::slug('Tartare tomates et avocats', '-'),
                'description' => "Notre tartare tomates et avocats marie l'élégance du fruit et la fraîcheur de l'avocat. Des dés de tomates juteuses et d'avocats crémeux sont délicatement associés avec des herbes aromatiques et une vinaigrette légère pour créer une entrée délicieusement équilibrée. Une explosion de saveurs végétales qui réveillera vos papilles et vous plongera dans une expérience gustative inoubliable.",
                'image' => '/uploads/seeders/recipe/2-tartare_tomates_avocats.jpg',
                'price' => 7.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => 'Pico de gallo',
                'slug' => Str::slug('Pico de gallo', '-'),
                'description' => "Notre Pico de Gallo est un condiment frais et épicé originaire du Mexique. Il est préparé avec des tomates fraîches, des oignons rouges, du piment jalapeño, du cilantro et du jus de citron vert, créant ainsi une explosion de saveurs vives et piquantes. Il accompagne à merveille nos plats tex-mex, tacos, ou sert de trempette pour des tortillas croustillantes. Laissez-vous emporter par la vivacité de la cuisine mexicaine avec chaque bouchée de notre Pico de Gallo.",
                'image' => '/uploads/seeders/recipe/3-pico_de_gallo.jpg',
                'price' => 9.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => 'Piperade',
                'slug' => Str::slug('Piperade', '-'),
                'description' => "Notre piperade est une spécialité basque qui marie harmonieusement les poivrons rouges, les tomates, les oignons et les épices. Cette préparation savoureuse est cuite lentement pour révéler des saveurs profondes et légèrement fumées. Accompagnée d'œufs pochés ou de jambon de Bayonne, elle vous transportera directement dans le cœur du Pays Basque, une expérience culinaire authentique qui éveillera vos papilles",
                'image' => '/uploads/seeders/recipe/4-piperade_au_thermomix.jpg',
                'price' => 10.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Méli mélo de légumes",
                'slug' => Str::slug('Méli mélo de légumes', '-'),
                'description' => "Notre méli-mélo de Légumes est une explosion de couleurs et de saveurs. Un mélange de légumes frais, soigneusement sélectionnés, est sauté à la perfection pour préserver leur croquant naturel. Ce plat végétarien est accompagné d'une sauce légère à l'ail et aux herbes qui sublime chaque bouchée. Découvrez une symphonie de légumes qui éveillera vos sens et vous offrira une expérience culinaire saine et délicieuse.",
                'image' => '/uploads/seeders/recipe/5-meli_melo_poivrons_tomates_courgette_ail.jpg',
                'price' => 6.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Salade keto",
                'slug' => Str::slug('Salade keto', '-'),
                'description' => "Notre salade Keto est spécialement conçue pour ceux qui suivent un régime cétogène. Des légumes frais, des avocats crémeux, des noix croquantes et une vinaigrette à l'huile d'olive s'associent pour créer une salade riche en graisses saines et faible en glucides. Un choix délicieux pour rester fidèle à votre mode de vie keto tout en savourant une explosion de saveurs et de textures. Une salade qui vous aide à atteindre vos objectifs nutritionnels sans compromis sur le goût.",
                'image' => '/uploads/seeders/recipe/6-salade_keto.jpeg',
                'price' => 6.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Salade de Poulet",
                'slug' => Str::slug('Salade de Poulet', '-'),
                'description' => "Notre salade de Poulet est une symphonie de saveurs et de textures. Des morceaux de poulet grillé, tendres et juteux, sont associés à des légumes frais et croquants, le tout couronné d'une vinaigrette maison légèrement crémeuse. Une option saine et satisfaisante pour les amateurs de poulet, cette salade est parfaite pour un repas équilibré et délicieux. Découvrez le mariage parfait du poulet et des légumes dans chaque bouchée",
                'image' => '/uploads/seeders/recipe/7-salade_poulet.jpg',
                'price' => 9.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Soupe de lentilles corail",
                'slug' => Str::slug('Soupe de lentilles corail', '-'),
                'description' => "Riche en fer et en vitamines, la lentille corail se distingue par sa jolie couleur orangée et son goût légèrement sucré. Elle fleure bon la cuisine orientale où elle est très présente. Très plébiscité par les végétariens, la lentille corail est aussi une excellente source de protéines. Confectionnez une délicieuse soupe de lentilles corail au Monsieur cuisine. Délicatement parfumée au cumin, cette soupe va vous réchauffer avec des saveurs orientales et savoureuses.",
                'image' => '/uploads/seeders/recipe/8-soupe_lentille_corail.jpeg',
                'price' => 5.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Soupe de haricots verts",
                'slug' => Str::slug('Soupe de haricots verts', '-'),
                'description' => "Notre soupe de Lentilles Corail est une délicieuse explosion de saveurs exotiques. Les lentilles corail, riches en nutriments, sont mijotées avec des épices aromatiques et des légumes frais pour créer une soupe crémeuse et parfumée. Un voyage culinaire qui éveillera vos papilles et vous réchauffera le cœur. Dégustez cette soupe nutritive et réconfortante pour une expérience gustative inoubliable.",
                'image' => '/uploads/seeders/recipe/9-soupe_haricots_verts.jpg',
                'price' => 4.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Soupe de poireaux",
                'slug' => Str::slug('Soupe de poireaux', '-'),
                'description' => "Notre soupe de Poireaux est une symphonie de saveurs douces et réconfortantes. Les poireaux frais sont mijotés avec des pommes de terre et des épices pour créer une soupe veloutée et délicieusement crémeuse. Cette option légère est parfaite en entrée ou en plat principal pour une expérience gastronomique simple et délicieuse. Découvrez le réconfort dans chaque cuillère de notre Soupe de Poireaux.",
                'image' => '/uploads/seeders/recipe/10-soupe_de_poireaux.jpg',
                'price' => 4.50,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Soupe aux lentilles",
                'slug' => Str::slug('Soupe aux lentilles', '-'),
                'description' => "Notre soupe aux Lentilles est un véritable régal pour les amateurs de cuisine réconfortante. Les lentilles riches en protéines sont mijotées avec des légumes savoureux, des épices aromatiques et un bouillon parfumé pour créer une soupe consistante et pleine de saveurs. Un choix sain et satisfaisant qui vous réchauffera le cœur. Plongez dans une expérience gustative nourrissante avec chaque cuillère de notre Soupe aux Lentilles.",
                'image' => '/uploads/seeders/recipe/11-soupe_aux_lentilles.jpg',
                'price' => 4.25,
                'available' => 1,

            ],

            // Plats principaux

            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Pâte carbonara",
                'slug' => Str::slug('Pâte carbonara', '-'),
                'description' => "Notre pâte Carbonara est une véritable invitation à la cuisine italienne classique. Des pâtes fraîches sont généreusement enrobées d'une sauce crémeuse à base de pancetta croustillante, de jaunes d'œufs et de parmesan frais. Chaque bouchée offre un mélange parfait de saveurs riches et salées, créant un équilibre exquis. Découvrez l'authenticité de la carbonara italienne dans ce plat incontournable, un régal pour les amateurs de pâtes.",
                'image' => '/uploads/seeders/recipe/12-pate_carbonara.jpg',
                'price' => 12.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Courgettes et lardons",
                'slug' => Str::slug('Courgettes et lardons', '-'),
                'description' => "Notre plat de courgettes et lardons est une fusion parfaite de légumes frais et de lardons croustillants. Les courgettes sont sautées à la perfection, absorbant les arômes fumés des lardons, pour créer une combinaison de saveurs délicieusement harmonieuse. Un accompagnement polyvalent qui ajoute une touche de gourmandise à n'importe quel plat principal ou qui peut être apprécié en solo pour une expérience simple et savoureuse",
                'image' => '/uploads/seeders/recipe/13-courgettes_lardon.jpg',
                'price' => 13.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Risotto aux champignons",
                'slug' => Str::slug('Risotto aux champignons', '-'),
                'description' => "Notre risotto aux champignons est un hommage à la gastronomie italienne. Le riz Arborio est lentement cuit dans un bouillon riche aux champignons sauvages, le tout garni de champignons frais sautés, de parmesan fondu et d'une touche de persil frais. Chaque bouchée offre une expérience crémeuse et umami, vous transportant dans les collines italiennes. Découvrez l'élégance et la simplicité de notre Risotto aux Champignons, une expérience culinaire inoubliable",
                'image' => '/uploads/seeders/recipe/14-risotto_aux_champignons.jpeg',
                'price' => 14.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Salade turque",
                'slug' => Str::slug('Salade turque', '-'),
                'description' => "Notre salade turque est une explosion de saveurs méditerranéennes. Elle associe des concombres croquants, des tomates juteuses, des olives noires, du fromage feta et des herbes fraîches, le tout assaisonné d'une vinaigrette au citron et à l'huile d'olive. Une combinaison rafraîchissante et savoureuse qui évoque l'authenticité de la cuisine turque. Dégustez une salade légère et délicieuse qui vous transporte instantanément en Turquie",
                'image' => '/uploads/seeders/recipe/15-salade_turque.jpg',
                'price' => 12.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Sauté de veau aux carottes",
                'slug' => Str::slug('Sauté de veau aux carottes', '-'),
                'description' => "Notre sauté de veau aux carottes est une véritable ode à la cuisine française traditionnelle. De tendres morceaux de veau sont mijotés avec des carottes fondantes dans une sauce riche et parfumée. Un mariage de saveurs délicates qui offre une expérience gastronomique réconfortante. Plongez dans la tradition et la finesse de la cuisine française avec chaque bouchée de notre sauté de veau aux carottes.",
                'image' => '/uploads/seeders/recipe/16-saute_de_boeuf_aux_legumes_et_au-riz.png',
                'price' => 13.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Wok de légumes épicés et sauce soja",
                'slug' => Str::slug('Wok de légumes épicés et sauce soja', '-'),
                'description' => "Notre wok de légumes épicés et sauce soja est un mélange explosif de saveurs asiatiques. Des légumes croquants sont sautés à la perfection dans une sauce soja relevée, accompagnés de notes d'ail et de gingembre. Une harmonie parfaite de douceur et de piquant qui éveille vos papilles. Découvrez l'art de la cuisine asiatique avec chaque bouchée de notre wok de légumes épicés",
                'image' => '/uploads/seeders/recipe/17-wok_legumes_epices_sauce_soja.jpeg',
                'price' => 12.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Polenta aux légumes",
                'slug' => Str::slug('Polenta aux légumes', '-'),
                'description' => "Notre polenta aux légumes est un mélange délicieusement réconfortant. la polenta crémeuse est associée à une variété de légumes frais, cuits à la perfection pour une texture tendre et des saveurs riches. chaque bouchée est une explosion de douceur et de nutriments, parfaite pour les amateurs de plats végétariens. cette création culinaire est une expérience gastronomique qui ravira vos papilles et réchauffera votre cœur. découvrez la simplicité et la gourmandise de notre polenta aux légumes, une option saine et délicieuse pour tous les appétits",
                'image' => 'uploads/seeders/recipe/18-polenta_aux_legumes.jpeg',
                'price' => 10.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Sauté de boeuf aux légumes et au riz",
                'slug' => Str::slug('Sauté de boeuf aux légumes et au riz', '-'),
                'description' => "Notre sauté de bœuf aux légumes et au riz est une explosion de saveurs. des morceaux de bœuf tendres sont associés à une variété de légumes frais, le tout servi sur un lit de riz parfumé. une combinaison parfaite de textures et de goûts qui ravira vos papilles. cette création culinaire équilibrée est une option satisfaisante pour les amateurs de viande et de légumes. découvrez l'harmonie des saveurs dans chaque bouchée de notre sauté de bœuf aux légumes et au riz, une expérience gastronomique à ne pas manquer",
                'image' => '/uploads/seeders/recipe/19-saute_de_boeuf_aux_carottes.jpg',
                'price' => 9.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Riz blanc à la sauce au poulet et curry",
                'slug' => Str::slug('Riz blanc à la sauce au poulet et curry', '-'),
                'description' => "Notre riz blanc à la sauce au poulet et au curry est un voyage gustatif exotique. des morceaux de poulet tendres sont nappés d'une sauce au curry parfumée, puis servis sur un lit de riz blanc moelleux. une fusion parfaite de saveurs épicées et douces qui éveillera vos papilles. cette création culinaire offre une expérience gastronomique délicieusement réconfortante pour les amateurs de cuisine exotique. découvrez l'authenticité des épices et du poulet dans chaque bouchée de notre riz blanc à la sauce au poulet et curry",
                'image' => '/uploads/seeders/recipe/20-riz_blanc_sauce_au_poulet.jpeg',
                'price' => 11.75,
                'available' => 1,

            ],

            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Piperade à l’œuf",
                'slug' => Str::slug('Piperade à l’œuf', '-'),
                'description' => "Notre piperade à l’œuf est une explosion de saveurs basques. des poivrons rouges et des tomates mijotent avec des œufs pour créer une préparation onctueuse et riche en goût. une combinaison parfaite de douceur et de richesse, cette création culinaire réveillera vos papilles. découvrez l'authenticité de la cuisine basque dans chaque bouchée de notre piperade à l’œuf, une expérience gastronomique inoubliable",
                'image' => '/uploads/seeders/recipe/21-piperade_oeuf.jpg',
                'price' => 11.75,
                'available' => 1,

            ],

            // Desserts

            [
                'category_id' => $cat_dsrt_id,
                'restaurant_id' => $resto_id,
                'name' => "Glace au Kinder",
                'slug' => Str::slug('Glace au Kinder', '-'),
                'description' => "Notre glace au Kinder est une véritable gourmandise. Elle marie la douceur du chocolat Kinder à la fraîcheur d'une crème glacée onctueuse. Chaque cuillère est une explosion de saveurs sucrées et crémeuses qui comblera tous les amateurs de Kinder. Découvrez le plaisir de l'enfance dans chaque dégustation de notre glace au Kinder, une expérience glacée irrésistible.",
                'image' => '/uploads/seeders/recipe/22-glace-au-kinder.jpg',
                'price' => 4.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_dsrt_id,
                'restaurant_id' => $resto_id,
                'name' => "Glace aux cacahuètes",
                'slug' => Str::slug('Glace aux cacahuètes', '-'),
                'description' => "Notre glace aux cacahuètes est un pur délice pour les amateurs de cacahuètes. Des morceaux croquants de cacahuètes grillées sont mélangés à une crème glacée veloutée pour créer une expérience de glace à la fois riche en saveur et en texture. Découvrez le mariage parfait de la douceur crémeuse et du croquant des cacahuètes dans chaque cuillère de notre glace aux cacahuètes, une expérience glacée qui vous transportera au paradis des arachides.",
                'image' => '/uploads/seeders/recipe/23-glace-cacahuete.jpg',
                'price' => 3.50,
                'available' => 1,

            ],
            [
                'category_id' => $cat_dsrt_id,
                'restaurant_id' => $resto_id,
                'name' => "Glace aux fruits",
                'slug' => Str::slug('Glace aux fruits', '-'),
                'description' => "Notre glace aux fruits est une explosion de fraîcheur et de saveurs naturelles. Nous utilisons des fruits frais et juteux pour créer une glace légère et rafraîchissante. Chaque cuillère offre une palette de goûts fruités qui évoque l'été en bouche. Découvrez la simplicité et la délicatesse de notre glace aux fruits, une expérience glacée idéale pour une douce escapade gustative.",
                'image' => '/uploads/seeders/recipe/24-glace-aux-fruits.jpg',
                'price' => 3.50,
                'available' => 1,

            ],
            [
                'category_id' => $cat_dsrt_id,
                'restaurant_id' => $resto_id,
                'name' => "Gâteau roulé au chocolat Noir",
                'slug' => Str::slug('Gâteau roulé au chocolat Noir', '-'),
                'description' => "Notre gâteau roulé au chocolat noir est une véritable symphonie chocolatée. Une génoise moelleuse est généreusement garnie d'une ganache au chocolat noir riche et veloutée. Chaque bouchée est une explosion de saveurs intenses et gourmandes. Découvrez la sophistication du chocolat noir dans notre gâteau roulé, une expérience sucrée irrésistible pour les amateurs de chocolat.",
                'image' => '/uploads/seeders/recipe/25-gateau-chocolat-noir.jpeg',
                'price' => 6.50,
                'available' => 1,

            ],
            [
                'category_id' => $cat_dsrt_id,
                'restaurant_id' => $resto_id,
                'name' => "Tartelettes feuilletées aux fruits",
                'slug' => Str::slug('Tartelettes feuilletées aux fruits', '-'),
                'description' => "Nos tartelettes feuilletées aux fruits sont des délices fruités et croustillants. Une pâte feuilletée légère et dorée est garnie de fruits frais de saison, créant ainsi un équilibre parfait entre croquant et tendreté. Chaque bouchée offre une explosion de saveurs fruitées et sucrées qui éveillera vos papilles. Découvrez la fraîcheur des fruits dans nos tartelettes feuilletées,une expérience sucrée légère et délicieuse.",
                'image' => '/uploads/seeders/recipe/26-tartelettes-aux-fruits.jpeg',
                'price' => 7.50,
                'available' => 1,

            ],
            [
                'category_id' => $cat_dsrt_id,
                'restaurant_id' => $resto_id,
                'name' => "Dessert au yaourt",
                'slug' => Str::slug('Dessert au yaourt', '-'),
                'description' => "Notre dessert au yaourt est une expérience légère et rafraîchissante. Un yaourt velouté est servi avec une touche de douceur, que ce soit sous forme de miel, de fruits frais ou de granola croquant. Chaque cuillère offre un équilibre délicat entre crémeux et sucré, parfait pour une fin de repas légère et satisfaisante. Découvrez la simplicité et la fraîcheur dans chaque bouchée de notre dessert au yaourt, une option idéale pour conclure votre repas en beauté.",
                'image' => '/uploads/seeders/recipe/27-dessert-au-yaourt.jpg',
                'price' => 4.75,
                'available' => 1,

            ],

        ];

        $base = Carbon::now();


        // Créer des menus à une minute d'intervalle.

        foreach ($plats as $index => $plat) {
            $timeInterval = $index * 60;
            $createdAt = Carbon::parse($base)->addSeconds($timeInterval);
            $updatedAt = $createdAt;

            $menus[$index]['created_at'] = $createdAt;
            $menus[$index]['updated_at'] = $updatedAt;
        }

        Plat::insert($plats);
    }
}
