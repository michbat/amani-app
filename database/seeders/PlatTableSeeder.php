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
                'description' => "Invitez le soleil à table avec notre recette de tomates séchées à l'huile d'olive ! Parfaites comme antipasti au moment d'un apéritif dinatoire, les réaliser est un vrai jeu d'enfant. Elles agrémenteront également à la perfection vos cakes salés, salades composées, tartes salées... de quoi donner un parfum de Méditerranée à vos repas !",
                'image' => '/uploads/seeders/recipe/1-tomates_sechees.jpg',
                'price' => 8.75,
                'available' => 1,


            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => 'Tartare tomates et avocats',
                'slug' => Str::slug('Tartare tomates et avocats', '-'),
                'description' => "Rien de plus frais qu'un joli tartare de tomates et d'avocats à présenter à vos invités en entrée. Un plat simple et végétarien qui plaira à tous les gourmands, grands comme petits. Et pourquoi ne pas remplir de jolies verrines à servir en apéritif ? Avec ses trois couches colorées et ses saveurs parfumées, le tartare veggie est simplement parfait !",
                'image' => '/uploads/seeders/recipe/2-tartare_tomates_avocats.jpg',
                'price' => 7.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => 'Pico de gallo',
                'slug' => Str::slug('Pico de gallo', '-'),
                'description' => "Le pico de gallo ou « salsa fresca » est une sauce originaire du Mexique, idéale à l’apéritif, elle peut aussi servir d’entrée. Très facile à réaliser, elle se compose de tomates, de coriandre fraîche hachée, d’oignon blanc, de jus de lime et de piment. Une sauce pleine de saveurs, typique de la cuisine mexicaine, qui ravira vos invités pendant l’été !",
                'image' => '/uploads/seeders/recipe/3-pico_de_gallo.jpg',
                'price' => 9.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => 'Piperade',
                'slug' => Str::slug('Piperade', '-'),
                'description' => "Envie de soleil dans votre assiette ? Nous vous proposons une recette du sud-ouest de la France qui régalera petits et grands de la maison. Il vous faut des poivrons, de l’huile, des tomates, des oignons, du sel, du poivre et place à la préparation de votre piperade au Thermomix.",
                'image' => '/uploads/seeders/recipe/4-piperade_au_thermomix.jpg',
                'price' => 10.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Méli mélo de légumes",
                'slug' => Str::slug('Méli mélo de légumes', '-'),
                'description' => "Découvrez notre Méli-mélo de poivrons, tomates et courgettes à l'ail, une explosion de couleurs et de saveurs. Les poivrons, tomates et courgettes se mêlent harmonieusement, créant une symphonie visuelle et gustative. L'ail ajoute une note aromatique qui rehausse l'ensemble. Chaque bouchée est une dégustation de fraîcheur et de légèreté, mettant en avant la beauté de la nature dans ce mélange vibrant. Plongez dans cette création culinaire qui évoque la simplicité et la fraîcheur des ingrédients de saison.",
                'image' => '/uploads/seeders/recipe/5-meli_melo_poivrons_tomates_courgette_ail.jpg',
                'price' => 6.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Salade keto",
                'slug' => Str::slug('Salade keto', '-'),
                'description' => "Cette salade pleine de fraîcheur au thon et à l’avocat est parfaite pour un déjeuner sur le pouce ou un dîner léger ! Riche en protéines et en graisses de qualité, elle est 100% adaptée à l’alimentation cétogène et saura ravir vos papilles. Pensez à l’agrémenter selon vos goûts et selon les saisons !",
                'image' => '/uploads/seeders/recipe/6-salade_keto.jpeg',
                'price' => 6.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Salade de Poulet",
                'slug' => Str::slug('Salade de Poulet', '-'),
                'description' => "Voilà une recette à la fois gourmande et équilibrée qui vous permettra de vous régaler à l'heure du déjeuner ou du dîner. Cette salade au poulet, agrémentée de tomates, d'œufs, de fromage et de laitue est extrêmement facile et rapide à réaliser. Pleine de fraîcheur, elle sera également la bienvenue pour un pique-nique sain et savoureux. Une chose est sûre, cette recette émerveillera les papilles de tous les gourmands",
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
                'description' => "Découvrez une douceur rustique avec notre Soupe de haricots verts. Les haricots verts tendres et parfumés sont subtilement mijotés pour créer une base onctueuse et réconfortante. Chaque cuillerée offre une immersion dans la simplicité des ingrédients, mettant en valeur la fraîcheur et la saveur naturelle des haricots. Plongez dans cette dégustation qui évoque la chaleur de la cuisine maison et le réconfort d'une soupe préparée avec soin. Une expérience culinaire qui célèbre la beauté des plats simples et délicieux.",
                'image' => '/uploads/seeders/recipe/9-soupe_haricots_verts.jpg',
                'price' => 4.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Soupe de poireaux",
                'slug' => Str::slug('Soupe de poireaux', '-'),
                'description' => "Au coeur de l'hiver, pour vous réconforter du froid et de la grisaille, vous cherchez une recette facile qui vous tienne au corps sans pour autant peser trop lourd sur la balance... Bienvenue dans le paradis des soupes de légumes qui font la part belle au goût et la part pauvre aux calories. Parmi elles, cette recette de velouté aux poireaux et pommes de terre vous permettra d'enchanter votre souper (ou pourquoi pas votre déjeuner) et celui de ceux que vous aiment",
                'image' => '/uploads/seeders/recipe/10-soupe_de_poireaux.jpg',
                'price' => 4.50,
                'available' => 1,

            ],
            [
                'category_id' => $cat_en_id,
                'restaurant_id' => $resto_id,
                'name' => "Soupe aux lentilles",
                'slug' => Str::slug('Soupe aux lentilles', '-'),
                'description' => "Le bonheur de déguster une bonne soupe lorsque les températures rafraîchissent... Un bonheur simple et sain, qui fait du bien au coeur et au corps. Cette super recette vous propose de réaliser une délicieuse soupe aux lentilles, avec juste ce qu'il faut d'oignons, de persil, de sauce soja... Un délice qui fera l'unanimité autour de la tablée. Voilà donc une recette à tester très très vite, et à garder très très longtemps parce qu'on parie que vous la ressortirez avec plaisir et gourmandise tous les ans !",
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
                'description' => "Une recette italienne traditionnelle avec beaucoup de variante pour le plaisir des petits comme des grands ! Notre recette de pâte carbonara est simple, rapide et efficace ! Peu d’ingrédients, des pâtes, du jaune d’œuf, des lardons, du parmesan, de la crème fraîche, un oignon, du sel, du poivre, et c’est tout ! Place à la préparation avec le Cookeo de Moulinex.",
                'image' => '/uploads/seeders/recipe/12-pate_carbonara.jpg',
                'price' => 12.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Courgettes et lardons",
                'slug' => Str::slug('Courgettes et lardons', '-'),
                'description' => "Simple, facile et rapide, vous allez préparer votre dîner en 15 min chrono, 5 min de préparation et 10 min de cuisson. Un repas réussi pour toute la famille. Des courgettes, des lardons, de l’oignon, des herbes de Provence et des aromates. Prêt pour la préparation de vos Courgettes et lardons au Cookeo.",
                'image' => '/uploads/seeders/recipe/13-courgettes_lardon.jpg',
                'price' => 13.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Risotto aux champignons",
                'slug' => Str::slug('Risotto aux champignons', '-'),
                'description' => "Tout droit venu d'Italie, le risotto est un plat dont nous raffolons ! Sa cuisson est délicate à cause de l'absorption de l’eau, c'est pourquoi il nous faut rester derrière notre casserole. Avec votre Cookeo, il se fera tout seul, sans surveillance grâce à sa cuisson sous pression. Nous ne connaissons pas meilleure solution pour se régaler sans effort ! En avant pour la préparation de votre risotto aux champignons au Cookeo.",
                'image' => '/uploads/seeders/recipe/14-risotto_aux_champignons.jpeg',
                'price' => 14.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Salade turque",
                'slug' => Str::slug('Salade turque', '-'),
                'description' => "La salade turque (ou Çoban salatasi), est une salade extra fraîche à réaliser en été. C’est une recette traditionnelle de la cuisine turque, que l’on peut déguster lors des repas pendant le ramadan. La salade turque est très simple à réaliser et peut être préparer en grande quantité la veille afin que les saveurs se mélangent entre elles.",
                'image' => '/uploads/seeders/recipe/15-salade_turque.jpg',
                'price' => 12.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Sauté de veau aux carottes",
                'slug' => Str::slug('Sauté de veau aux carottes', '-'),
                'description' => "Vous cherchez une idée recette pour votre déjeuner familial de dimanche midi ? Voici une délicieuse recette avec de la viande de veau, des légumes, du bouillon de volaille, un bouquet garni, de la crème, et quelques herbes et aromates. Place à la préparation de votre Sauté de veau aux carottes au Cookeo.",
                'image' => '/uploads/seeders/recipe/16-saute_de_boeuf_aux_legumes_et_au-riz.png',
                'price' => 13.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Wok de légumes épicés et sauce soja",
                'slug' => Str::slug('Wok de légumes épicés et sauce soja', '-'),
                'description' => "Cette recette au wok permet une cuisson lente et un développement subtil des arômes des légumes et aussi des épices. Ce wok de légumes épicés plus ou moins fort selon vos goûts, éveillera vos papilles gustatives. L'utilisation de la sauce soja permet d'apporter une saveur salée et donc nul besoin d'ajouter de sel. Un petit mélange de légumes, soja et champignons et cela fait une recette avec une petite touche asiatique.",
                'image' => '/uploads/seeders/recipe/17-wok_legumes_epices_sauce_soja.jpeg',
                'price' => 12.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Polenta aux légumes",
                'slug' => Str::slug('Polenta aux légumes', '-'),
                'description' => "La polenta aux légumes, vous connaissez ? Cette recette, originale et rapide à réaliser, conviendra parfaitement aux sans gluten. Les légumes du soleil apporteront beaucoup de saveurs dans votre assiette.",
                'image' => 'uploads/seeders/recipe/18-polenta_aux_legumes.jpeg',
                'price' => 10.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Sauté de boeuf aux légumes et au riz",
                'slug' => Str::slug('Sauté de boeuf aux légumes et au riz', '-'),
                'description' => "Le principe des plats mijotés est de mettre tous les ingrédients dans une cocotte et de laisser mijoter le tout comme son nom l'indique. Et hop, vous n'avez plus qu'à attendre que cela se fasse. Cuisiner sans passer tout son temps dans les casseroles, c'est agréable n'est-ce pas ?",
                'image' => '/uploads/seeders/recipe/19-saute_de_boeuf_aux_carottes.jpg',
                'price' => 9.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Riz blanc à la sauce au poulet et curry",
                'slug' => Str::slug('Riz blanc à la sauce au poulet et curry', '-'),
                'description' => "Vous aimez le curry ? Vous allez adorer cette recette super facile à réaliser : le riz et sa sauce de poulet au curry. Un délice qui vous fait voyager illico presto et vous emmène en balade dans ces marchés aux épices où les couleurs vibrent et les odeurs ennivrent... Une petite 1/2 de préparation pour un si beau voyage, ça vaut le coup non ? Allez hop, du riz, des filets de poulet, un oignon, du bouillon de volaille, de la crème, et évidemment du curry ! Top c'est parti ! Bon voyage !",
                'image' => '/uploads/seeders/recipe/20-riz_blanc_sauce_au_poulet.jpeg',
                'price' => 11.75,
                'available' => 1,

            ],

            [
                'category_id' => $cat_pp_id,
                'restaurant_id' => $resto_id,
                'name' => "Piperade à l’œuf",
                'slug' => Str::slug('Piperade à l’œuf', '-'),
                'description' => "La piperade est un plat d’origine basque reposant traditionnellement sur une compotée de tomates et de piments doux, parfois déclinée avec des poivrons pour plus de douceur. Gorgée de saveurs, elle accompagne aussi bien de la viande que du poisson. Si certains lient leur préparation avec un œuf en fin de cuisson, cette recette reprend l’esprit chakchouka en la servant avec des œufs au plat, qui cuisent directement au milieu des légumes. Un plat unique, pratique et ensoleillé !",
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
                'description' => "La glace au Kinder, une délicieuse fusion de chocolat au lait crémeux et de morceaux de Kinder, vous transporte dans un monde de gourmandise. Découvrez une expérience glacée irrésistible qui éveille vos papilles avec chaque bouchée, pour un plaisir sucré inoubliable. Fondante et exquise, la glace au Kinder ravira les amateurs de chocolat.",
                'image' => '/uploads/seeders/recipe/22-glace-au-kinder.jpg',
                'price' => 4.75,
                'available' => 1,

            ],
            [
                'category_id' => $cat_dsrt_id,
                'restaurant_id' => $resto_id,
                'name' => "Glace aux cacahuètes",
                'slug' => Str::slug('Glace aux cacahuètes', '-'),
                'description' => "La glace aux cacahuètes, une gourmandise onctueuse et croquante qui marie la douceur de la crème glacée à la richesse des cacahuètes grillées. Découvrez une expérience glacée à la fois crémeuse et texturée, pour une explosion de saveurs salées et sucrées en une seule cuillerée. Plongez dans le délice de la glace aux cacahuètes.",
                'image' => '/uploads/seeders/recipe/23-glace-cacahuete.jpg',
                'price' => 3.50,
                'available' => 1,

            ],
            [
                'category_id' => $cat_dsrt_id,
                'restaurant_id' => $resto_id,
                'name' => "Glace aux fruits",
                'slug' => Str::slug('Glace aux fruits', '-'),
                'description' => "La glace aux fruits, une symphonie rafraîchissante de saveurs naturelles qui évoque la fraîcheur des fruits mûrs. Découvrez une expérience glacée légère et fruitée, parfaite pour rafraîchir vos papilles avec une explosion de goûts naturels. Savourez la douceur des fruits dans chaque cuillerée de cette glace délicieuse.",
                'image' => '/uploads/seeders/recipe/24-glace-aux-fruits.jpg',
                'price' => 3.50,
                'available' => 1,

            ],
            [
                'category_id' => $cat_dsrt_id,
                'restaurant_id' => $resto_id,
                'name' => "Gâteau roulé au chocolat Noir",
                'slug' => Str::slug('Gâteau roulé au chocolat Noir', '-'),
                'description' => "Le gâteau roulé au chocolat noir, un délice moelleux où le cacao intense du chocolat noir se marie à la légèreté du biscuit roulé. Découvrez une expérience sucrée et fondante qui ravit les amateurs de chocolat avec chaque bouchée. Succombez au plaisir du gâteau roulé au chocolat noir pour une touche de gourmandise exquise.",
                'image' => '/uploads/seeders/recipe/25-gateau-chocolat-noir.jpeg',
                'price' => 6.50,
                'available' => 1,

            ],
            [
                'category_id' => $cat_dsrt_id,
                'restaurant_id' => $resto_id,
                'name' => "Tartelettes feuilletées aux fruits",
                'slug' => Str::slug('Tartelettes feuilletées aux fruits', '-'),
                'description' => "Les tartelettes feuilletées aux fruits, des délices croustillants et fruités qui combinent la finesse du feuilletage avec la fraîcheur des fruits. Découvrez une explosion de saveurs sucrées et acidulées dans chaque bouchée, pour une expérience gourmande légère et exquise. Succombez au charme des tartelettes feuilletées aux fruits pour un plaisir gustatif irrésistible.",
                'image' => '/uploads/seeders/recipe/26-tartelettes-aux-fruits.jpeg',
                'price' => 7.50,
                'available' => 1,

            ],
            [
                'category_id' => $cat_dsrt_id,
                'restaurant_id' => $resto_id,
                'name' => "Dessert au yaourt",
                'slug' => Str::slug('Dessert au yaourt', '-'),
                'description' => "Le dessert au yaourt, une douceur crémeuse et légère, parfaite pour apaiser votre palais avec une touche de fraîcheur lactée. Découvrez une expérience sucrée et équilibrée, idéale en fin de repas ou en collation. Savourez la simplicité et la délicatesse du dessert au yaourt à chaque cuillerée.",
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