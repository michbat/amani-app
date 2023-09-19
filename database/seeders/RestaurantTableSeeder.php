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
            'reglement' => "<h4 class='text-center'>Termes et Conditions de Vente</h4><br><br>

            <p>Bienvenue chez Amani, votre restaurant de choix pour des délices culinaires inoubliables. Avant de passer votre commande, nous vous prions de lire attentivement nos Termes et Conditions de Vente, car ils définissent les règles et les responsabilités liées à votre expérience de commande chez Amani</p><br>

            <p>
            1. Commandes<br>

            Vous pouvez passer vos commandes en ligne via notre site Web .
            Veuillez vérifier soigneusement votre commande avant de la soumettre. Une fois confirmée, la commande ne peut être modifiée.
            Toutes les commandes sont sujettes à confirmation par Amani. Nous nous réservons le droit d'annuler toute commande, en tout ou en partie, en cas d'indisponibilité des produits ou de toute autre raison justifiée. Une fois la commande entrée en préparation, il n'est plus possible de l'annuler. En ligne, la commande d'une boisson est conditionnée à une commande d'un plat.
            </p><br>

            <p>2. Paiement

            Les prix des articles sont indiqués en Euro.
            Le paiement peut être effectué en ligne via les méthodes de paiement acceptées. À l'intérieur du restaurant, des paiements en espèces sont acceptés.
            Pour les paiements en ligne, des informations de carte de crédit ou d'autres informations de paiement sont traitées de manière sécurisée et confidentielle.</p><br>

            <p>
            3. Livraison<br>

            Nous garantissons la préparation d'une commande en 30 minutes à partir de la confirmation de celle-ci. Vous avez 1h30 pour retirer votre commande dans notre restaurant. Nous ne faisons pas de livraisons. C'est le client qui doit venir récupérer sa commande chez nous.</p><br>

            <p>
            4. Annulations et Remboursements<br>
            Les annulations de commande sont acceptées avant que votre plat n'entre en préparation. Veuillez nous contacter pour plus de détails.
            Les remboursements seront effectués conformément à notre politique de remboursement en vigueur. Nous nous efforçons de garantir votre satisfaction.</p><br>
            <p>
            5. Responsabilité<br>

            Amani s'engage à fournir des repas de qualité préparés avec soin. Cependant, nous ne pouvons être tenus responsables des allergies alimentaires ou des préférences alimentaires individuelles.
            En cas de produits défectueux ou non conformes à votre commande, veuillez nous en informer dans les plus brefs délais pour résoudre le problème de manière satisfaisante.</p><br>
            <p>
            6. Modification des Termes<br>

            Amani se réserve le droit de modifier ces Termes et Conditions de Vente à tout moment. Les modifications seront publiées sur notre site Web et seront effectives dès leur publication.
            Nous vous remercions de choisir Amani pour votre expérience culinaire. En passant une commande, vous acceptez automatiquement nos Termes et Conditions de Vente. Si vous avez des questions ou des préoccupations, n'hésitez pas à nous contacter. Nous sommes là pour rendre votre expérience chez Amani aussi agréable que possible.</p><br><br>

            Bon appétit !

            "

        ];

        Restaurant::insert($restaurant);
    }
}
