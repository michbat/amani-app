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


    // Lorsqu'il n'y qu'une seule page de plats, on cache la pagination

    public $hideOnSinglePage = true;

    // On utilise la pagination de bootstrap

    protected $paginationTheme = 'bootstrap';


    // Propriété pour afficher le nombre de plats par page

    public $pageItems = 12;

    // Propriété pour ordonner les plats par prix croissant ou décroissant, nouveauté, rating
    public $orderBy = "default";

    // Propriété de type tableau pour filtrer les plats par intervalles de prix

    public $priceIntervals = [];

    // Propriété de type tableau pour filtrer par catégories de plat

    public $cats = [];

    // Propriété pour activer ou désactiver le bouton "ajouter" en fonction de la plage d'horaire autorisée

    public $canBeCommended;

    /**
     *
     * La méthode updated() est appelée lorsqu'une propriété de notre composant change
     * à travers des actions de l'utilisateur sur la vue associée à platComponent.
     * Ici on "reset" l'ancienne pagination générée par un ancien affichage après un filtrage par exemple
     *
     */


    // Lorsqu'une propriété de notre composant change, la méthode updated() est appelée et on reinitialise notre pagination
    // Notamment pour tenir systématiquement compte des résultats de nos tris ou filtres.

    public function updated()
    {
        $this->resetPage();
    }

    // Lorsque la propriété $orderBy change, on crée une session pour sauvegarder le dernier critère de tri choisi à l'intérieur de la balise select de la vue
    // Ainsi lorsqu'on change de page en ayant déjà fait un filtrage et qu'on revient ensuite à la page affichant des plats,
    // On retrouve les résultats correspondant au critère de filtrage.

    // la méthode updatedOrderBy() surveille les changements de la propriétés $orderBy

    public function updatedOrderBy()
    {
        session()->put('sorting', $this->orderBy);  // Lorsque $orderBy, on sauvergarde son état dans une variable de session dont la clé est 'sorting'
    }

    // Méthode pour ajouter un plat dans le panier

    public function storePlat($plat_id, $plat_name, $plat_price)
    {
        /**
         * Un visiteur qui simule un panier ou un utilisateur qui n'est pas 'Generic' sont limités à 10 boisssons par commande. Il faut pouvroir les emmpêcher
         * d'ajouter un article-boisson si celui-ci a déjà atteint le nombre de 10 et ce ceux au niveau de la vue associé à 'DrinkComponent'
         */

        if (!Auth::user() || Auth::user()->firstname !== 'Generic') {

            foreach (Cart::instance('cart')->content() as $content) {
                if ($content->associatedModel == 'App\Models\Plat' && $content->id == $plat_id && $content->qty >= 6) {
                    return redirect()->route('plat')->with('warning', 'Vous avez déjà 6 articles de ce plat dans le panier! Impossible d\'en ajouter encore un!');
                }
            }

            Cart::instance('cart')->add($plat_id, $plat_name, 1, $plat_price)->associate('App\Models\Plat');
            return redirect()->route('plat')->with('success', 'Plat ajouté dans votre panier');
        }

        // L'utilisateur 'Generic' n'est soumis à aucune restriction en termes de quantité

        if (Auth::user()->firstname == 'Generic') {
            Cart::instance('cart')->add($plat_id, $plat_name, 1, $plat_price)->associate('App\Models\Plat');
            return redirect()->route('plat')->with('success', 'Plat ajouté dans votre panier');
        }
    }

    // Méthode pour ajouter un plat dans une wishlist

    public function addPlatToWishList($plat_id, $plat_name, $plat_price)
    {
        Cart::instance('wishlist')->add($plat_id, $plat_name, 1, $plat_price)->associate('App\Models\Plat');
        // $this->emitTo('wishlist-icon-component', 'refreshComponent');
        // session()->flash('success_message', 'Plat ajouté à votre liste de souhaits');
        return redirect()->route('plat')->with('success', 'Plat ajouté à votre liste de souhaits');
    }

    // Méthode pour enlèver un plat de la wishlist

    public function removePlatToWishList($plat_id)
    {
        foreach (Cart::instance('wishlist')->content() as $content) {
            if ($content->id == $plat_id) {
                Cart::instance('wishlist')->remove($content->rowId);
                // $this->emitTo('wishlist-icon-component', 'refreshComponent');
                // session()->flash('success_message', 'Plat enlevé de votre liste de souhaits');
                // return back();
                return redirect()->route('plat')->with('success', 'Plat enlevé à votre liste de souhaits');
            }
        }
    }


    public function render()
    {
        // La méthode statique query() permet de préparer notre objet $query aux prochaines requêtes eloquent en vue de filtrages

        $query = Plat::query();


        $query->leftJoin('reviews', 'plats.id', '=', 'reviews.plat_id')
            ->selectRaw('plats.*, floor(AVG(CASE WHEN reviews.published = 1 THEN reviews.rating ELSE NULL END)) as avg_rating')
            ->groupBy('plats.id', 'plats.name', 'plats.price', 'plats.slug', 'plats.category_id', 'plats.restaurant_id', 'plats.description', 'plats.image', 'plats.price', 'plats.available', 'plats.canBeCommended', 'plats.created_at', 'plats.updated_at');


        // Un fitrage par intervalle de prix

        if (!empty($this->priceIntervals)) {
            $priceIntervalRanges = [
                '0-5' => [0, 5],
                '5-10' => [5, 10],
                '10-15' => [10, 15],
                '15-20' => [15, 20],
                '20-25' => [20, 25],
            ];

            $selectedPriceRanges = array_map(function ($interval) use ($priceIntervalRanges) {
                return $priceIntervalRanges[$interval];
            }, $this->priceIntervals);

            $query->orWhere(function ($query) use ($selectedPriceRanges) {
                foreach ($selectedPriceRanges as $range) {
                    $query->orWhereBetween('price', $range);
                }
            });
        }


        // Un filtrage par categories

        if (!empty($this->cats)) {

            $query->whereIn('category_id', Category::whereIn('designation', $this->cats)->pluck('id'));
        }


        // On récupère notre variable de session dont la clé est 'sorting' et on l'affecte à la propriété $orderBy pour garder les résultats de
        // notre dernier critère de tri


        $this->orderBy = session()->get('sorting');

        // Ordonner nos plats par prix ascendant et descendant, nouveauté (ordre d'enregistrement dans la BDD), rating (mieux noté au mal noté)

        switch ($this->orderBy) {
            case 'ascendant':
                $query->orderBy('price', 'ASC');
                break;
            case 'descendant':
                $query->orderBy('price', 'DESC');
                break;
            case 'new':
                $query->orderBy('created_at', 'DESC');
                break;
            case 'rating':
                $query->orderBy('avg_rating', 'DESC');
            default:
                //
        }

        // Affichage du nombre de produits par page (4,8,12,16,20)

        $plats = $query->paginate($this->pageItems);

        $categories = Category::orderBy('designation', 'ASC')->get();
        $categories = Category::where('designation', 'Entrées')->orWhere('designation', 'Plats principaux')->orWhere('designation', 'Desserts')->orderBy('designation', 'ASC')->get();

        // Si l'utilisateur authentifié  n'est pas 'Generic', on sauvegarde son panier et sa wishlist

        if (Auth::check() && Auth::user()->firstname !== 'Generic') {
            Cart::instance('cart')->store(Auth::user()->id);
            Cart::instance('wishlist')->store(Auth::user()->id);
        }

        // Si l'utilisateur connecté est 'Generic', on sauvegarde uniquement son panier

        if (Auth::check() && Auth::user()->firstname === 'Generic') {
            Cart::instance('cart')->store(Auth::user()->id);
        }



        return view('frontend.livewire.plat-component', compact('plats', 'categories'));
    }
}
