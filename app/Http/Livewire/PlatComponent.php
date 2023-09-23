<?php

namespace App\Http\Livewire;

use App\Models\Plat;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;


class PlatComponent extends Component
{
    use WithPagination;


    // Lorsqu'il n'y qu'une seule page de plats, on masque la pagination

    public $hideOnSinglePage = true;

    // On utilise la pagination de Bootstrap

    protected $paginationTheme = 'bootstrap';


    // Propriété pour afficher le nombre de plats par page

    public $pageItems = 12;

    // Propriété pour ordonner les plats par prix croissant ou décroissant, nouveauté.

    public $orderBy = "default";

    // Propriété de type tableau pour filtrer les plats par intervalles de prix

    public $priceIntervals = [];

    // Propriété de type tableau pour filtrer par catégories de plat

    public $cats = [];



    // Lorsqu'une propriété du composant change, la méthode updated() est appelée et je reinitialise notre pagination
    // pour notamment tenir compte de résultats de nos filtres.

    public function updated()
    {
        $this->resetPage();
    }

    // Méthode pour ajouter un plat dans le panier

    public function storePlat($plat_id, $plat_name, $plat_price)
    {
        if (!Auth::user() || Auth::user()->firstname !== 'Generic') {

            if (Cart::instance('cart')->content()->count() > 0) {

                foreach (Cart::instance('cart')->content() as $content) {
                    $plat = Plat::where('name', $plat_name)->first();

                    $ingredients = $plat->ingredients;

                    foreach ($ingredients as $ingredient) {
                        if ((($ingredient->quantityInStock / 3) - ($ingredient->pivot->amount * $content->qty)) <= $ingredient->quantityMinimum) {
                            return redirect()->route('plat')->with('warning', 'Vous ne pouvez plus ajouter ce plat. Stock limité.');
                        }
                    }


                    if ($content->associatedModel == 'App\Models\Plat' && $content->id == $plat_id && $content->qty >= 6) {
                        return redirect()->route('plat')->with('warning', 'Vous avez déjà 6 articles de ce plat dans le panier! Impossible d\'en ajouter encore un!');
                    }
                }
            } else {
                $plat = Plat::where('name', $plat_name)->first();

                $ingredients = $plat->ingredients;

                foreach ($ingredients as $ingredient) {
                    if ((($ingredient->quantityInStock / 3) - $ingredient->pivot->amount) <= $ingredient->quantityMinimum) {
                        return redirect()->route('plat')->with('warning', 'Vous ne pouvez plus ajouter ce plat. Stock limité.');
                    }
                }
            }

            // Si la limite n'a pas été atteinte, on ajoute le produit dans le panier

            Cart::instance('cart')->add($plat_id, $plat_name, 1, $plat_price)->associate('App\Models\Plat');
            return redirect()->route('plat')->with('success', 'Plat ajouté dans votre panier');
        }

        if (Auth::user()->firstname == 'Generic') {
            if (Cart::instance('cart')->content()->count() > 0) {

                foreach (Cart::instance('cart')->content() as $content) {
                    $plat = Plat::where('name', $plat_name)->first();

                    $ingredients = $plat->ingredients;

                    foreach ($ingredients as $ingredient) {
                        if ((($ingredient->quantityInStock / 3) - ($ingredient->pivot->amount * $content->qty)) <= $ingredient->quantityMinimum) {
                            return redirect()->route('plat')->with('warning', 'Vous ne pouvez plus ajouter ce plat. Stock limité.');
                        }
                    }
                }
            } else {
                $plat = Plat::where('name', $plat_name)->first();

                $ingredients = $plat->ingredients;

                foreach ($ingredients as $ingredient) {
                    if ((($ingredient->quantityInStock / 3) - $ingredient->pivot->amount) <= $ingredient->quantityMinimum) {
                        return redirect()->route('plat')->with('warning', 'Vous ne pouvez plus ajouter ce plat. Stock limité.');
                    }
                }
            }
            Cart::instance('cart')->add($plat_id, $plat_name, 1, $plat_price)->associate('App\Models\Plat');
            return redirect()->route('plat')->with('success', 'Plat ajouté dans votre panier');
        }
    }

    // Méthode pour ajouter un plat dans la wishlist

    public function addPlatToWishList($plat_id, $plat_name, $plat_price)
    {
        Cart::instance('wishlist')->add($plat_id, $plat_name, 1, $plat_price)->associate('App\Models\Plat');
        return redirect()->route('plat')->with('success', 'Plat ajouté à votre liste de souhaits');
    }

    // Méthode pour enlèver un plat de la wishlist

    public function removePlatToWishList($plat_id)
    {
        foreach (Cart::instance('wishlist')->content() as $content) {
            if ($content->id == $plat_id) {
                Cart::instance('wishlist')->remove($content->rowId);
                return redirect()->route('plat')->with('success', 'Plat enlevé à votre liste de souhaits');
            }
        }
    }


    public function render()
    {
        // La méthode statique query() permet de préparer notre objet $query aux prochaines requêtes eloquent en vue de filtrages

        $query = Plat::query();

        // Un fitrage par intervalle de prix

        // Je vérifie d'abord si $priceIntervals n'est pas vide auquel cas, l'utilisateur n'a pas utilisé le filtre par prix. la propriété $priceIntervals est bindée dans la vue associée à notre composant

        if (!empty($this->priceIntervals)) {
            // Je crée un tableau qui accueille les intervalles de prix affichées dans la vue
            $priceIntervalRanges = [
                '0-5' => [0, 5],   // 'O-5' est associée à la borne [0-5]
                '5-10' => [5, 10],
                '10-15' => [10, 15],
                '15-20' => [15, 20],
                '20-25' => [20, 25],
            ];

            // La fonction PHP array_map() recevant en paramètre une fonction callback, un tableau et retournant un tableau, mappe ici des intervalles de prix sélectionnées par le client donc stockées dans la propriété tableau $priceIntervals.

            $selectedPriceRanges = array_map(function ($interval) use ($priceIntervalRanges) {
                return $priceIntervalRanges[$interval]; // Retourne les bornes dont les clés ($interval) sont des valeurs se trouvant dans la propriété tableau $priceIntervals
            }, $this->priceIntervals);

            // Méthode orWhere est un constructeur de requêtes conditionnelles (les orWhereBetween dans la boucle foreach). On utilise une fonction callback pour regrouper ces requêtes conditionnelles.

            $query->orWhere(function ($query) use ($selectedPriceRanges) {
                // Je parcours les intervalles de prix sélectionnés se trouvant dans le tableau  $selectedPriceRanges
                foreach ($selectedPriceRanges as $range) {
                    $query->orWhereBetween('price', $range);  // Je vérifie si le prix est compris entre les bornes inférieures et supérieures de chaque intervalle cochée.
                }
            });
        }


        // Un filtrage par categories
        // Je vérifie d'abord si la propriété tableau $cats n'est pas vide

        if (!empty($this->cats)) {

            // Si oui, je récupère des catégories dont les ids correspondent aux ids de catégories dans le tableau $cats (donc cochées dans la vue)

            $query->whereIn('category_id', Category::whereIn('designation', $this->cats)->pluck('id'));
        }

        // Ordonner nos plats par prix ascendant et descendant, nouveauté (date d'enregistrement dans la BDD)

        switch ($this->orderBy) {
            case 'ascendant':
                $query->orderBy('price', 'ASC');  // Moins chère au plus chère
                break;
            case 'descendant':
                $query->orderBy('price', 'DESC');  // Plus chère au moins chère
                break;
            case 'new':
                $query->orderBy('created_at', 'DESC');  // De la date la plus recente à la date la plus ancienne
                break;
            default:
                //
        }

        // Affichage du nombre de produits par page (4,8,12,16,20)

        $plats = $query->paginate($this->pageItems);

        // Récupération de toutes les catégories de plats rangées par ordre alphabétique

        $categories = Category::where('designation', 'Entrées')->orWhere('designation', 'Plats principaux')->orWhere('designation', 'Desserts')->orderBy('designation', 'ASC')->get();

        // Si l'utilisateur authentifié  et n'est pas 'Generic', on sauvegarde son panier et sa wishlist

        if (Auth::check() && Auth::user()->firstname !== 'Generic') {
            Cart::instance('cart')->store(Auth::user()->id);
            Cart::instance('wishlist')->store(Auth::user()->id);
        }

        // Si l'utilisateur connecté est 'Generic', on sauvegarde uniquement son panier

        if (Auth::check() && Auth::user()->firstname === 'Generic') {
            Cart::instance('cart')->store(Auth::user()->id);
        }


        // On retourne la vue avec la collection d'objets "Plat" et "Category"

        return view('frontend.livewire.plat-component', compact('plats', 'categories'));
    }
}
