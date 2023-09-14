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


    public $hideOnSinglePage = true;
    protected $paginationTheme = 'bootstrap';


    // Propriété pour afficher le nombre de plats par page

    public $pageItems = 12;

    // Propriétés pour ordonner les plats par prix croissant ou décroissant, nouveauté, défaut
    public $orderBy = "default";

    // Propriétés pour filtrer les plats par intervalles de prix

    public $priceIntervals = [];

    // Propriété pour filtrer par catégories

    public $cats = [];

    // Propriété pour actver ou désactiver le bouton ajouter en fonction de la plage d'horaire autorisée

    public $canBeCommended;

    /**
     *
     * La méthode updated() est appelée lorsqu'une propriété de notre composant est mise à jour
     * via les interactions de l'utilisateur dans la vue associé à platComponent.
     * Ici on reset l'ancienne pagination générée d'une ancienne recherche pour laisser la place à une nouvelle pagination
     *
     */


    // Lorsqu'une propriété de notre composant change, la méthode updated() est appelée et on reinitialise notre pagination
    // Notamment pour tenir systématiquement compte des résultats de nos tris ou filtres.

    public function updated()
    {
        $this->resetPage();
    }

    // Lorsque la propriété $orderBy change, on crée une session pour sauvegarder le dernier critère de tri choisi dans le select
    // Ainsi lorsqu'on change de page en ayant déjà fait un filtrage et qu'on revient ensuite à la page affichant les plats,
    // On retrouve les résultats correspondant au critère de filtrage.

    public function updatedOrderBy()
    {
        session()->put('sorting', $this->orderBy);
    }

    // Méthode pour ajouter un plat dans le panier

    public function storePlat($plat_id, $plat_name, $plat_price)
    {
        Cart::instance('cart')->add($plat_id, $plat_name, 1, $plat_price)->associate('App\Models\Plat');
        $this->emitTo('cart-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Plat ajouté dans votre panier');
        return redirect()->route('cart');
    }

    // Méthode pour ajouter un plat dans une wishlist

    public function addPlatToWishList($plat_id, $plat_name, $plat_price)
    {
        Cart::instance('wishlist')->add($plat_id, $plat_name, 1, $plat_price)->associate('App\Models\Plat');
        $this->emitTo('wishlist-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Plat ajouté à votre liste de souhaits');
        return back();
    }

    // Méthode pour enlèver un plat de la wishlist

    public function removePlatToWishList($plat_id)
    {
        foreach (Cart::instance('wishlist')->content() as $content) {
            if ($content->id == $plat_id) {
                Cart::instance('wishlist')->remove($content->rowId);
                $this->emitTo('wishlist-icon-component', 'refreshComponent');
                session()->flash('success_message', 'Plat enlevé de votre liste de souhaits');
                return back();
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





        // Un fitrage sur l'intervalle de prix

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

        // Si le client est authentifié, on sauvegarde son panier et sa wishlist

        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->id);
            Cart::instance('wishlist')->store(Auth::user()->id);
        }

        return view('frontend.livewire.plat-component', compact('plats', 'categories'));
    }
}
