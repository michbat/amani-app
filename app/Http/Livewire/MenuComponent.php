<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;


class MenuComponent extends Component
{
    use WithPagination;


    public $hideOnSinglePage = true;
    protected $paginationTheme = 'bootstrap';


    // Propriété pour afficher le nombre de menus par page

    public $pageItems = 12;

    // Propriétés pour ordonner les menus par prix croissant ou décroissant, nouveauté, défaut
    public $orderBy = "default";

    // Propriétés pour filtrer les menus par intervalles de prix

    public $priceIntervals = [];

    // Propriété pour filtrer par catégories

    public $cats = [];

    // Propriété pour actver ou désactiver le bouton ajouter en fonction de la plage d'horaire autorisée

    public $canBeCommended;

    /**
     *
     * La méthode updated() est appelée lorsqu'une propriété de notre composant est mise à jour
     * via les interactions de l'utilisateur dans la vue associé à MenuComponent.
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
    // Ainsi lorsqu'on change de page en ayant déjà fait un filtrage et qu'on revient ensuite à la page affichant les menus,
    // On retrouve les résultats correspondant au critère de filtrage.

    public function updatedOrderBy()
    {
        session()->put('sorting', $this->orderBy);
    }

    // Méthode pour ajouter un menu dans le panier

    public function storeMenu($menu_id, $menu_name, $menu_price)
    {
        Cart::instance('cart')->add($menu_id, $menu_name, 1, $menu_price)->associate('App\Models\Menu');
        $this->emitTo('cart-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Menu ajouté dans votre panier');
        return redirect()->route('cart');
    }

    // Méthode pour ajouter un menu dans une wishlist

    public function addMenuToWishList($menu_id, $menu_name, $menu_price)
    {
        Cart::instance('wishlist')->add($menu_id, $menu_name, 1, $menu_price)->associate('App\Models\Menu');
        $this->emitTo('wishlist-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Menu ajouté à votre liste de souhaits');
        return back();
    }

    // Méthode pour enlèver un menu de la wishlist

    public function removeMenuToWishList($menu_id)
    {
        foreach (Cart::instance('wishlist')->content() as $content) {
            if ($content->id == $menu_id) {
                Cart::instance('wishlist')->remove($content->rowId);
                $this->emitTo('wishlist-icon-component', 'refreshComponent');
                session()->flash('success_message', 'Menu enlevé de votre liste de souhaits');
                return back();
            }
        }
    }


    public function render()
    {
        // La méthode statique query() permet de préparer notre objet $query aux prochaines requêtes eloquent en vue de filtrages

        $query = Menu::query();


        $query->leftJoin('reviews', 'menus.id', '=', 'reviews.menu_id')
            ->selectRaw('menus.*, floor(AVG(CASE WHEN reviews.published = 1 THEN reviews.rating ELSE NULL END)) as avg_rating')
            ->groupBy('menus.id', 'menus.name', 'menus.price', 'menus.slug', 'menus.category_id', 'menus.restaurant_id', 'menus.description', 'menus.image', 'menus.price', 'menus.available', 'menus.canBeCommended', 'menus.created_at', 'menus.updated_at');





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

        // Ordonner nos menus par prix ascendant et descendant, nouveauté (ordre d'enregistrement dans la BDD), rating (mieux noté au mal noté)

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

        $menus = $query->paginate($this->pageItems);

        $categories = Category::orderBy('designation', 'ASC')->get();
        $categories = Category::where('designation', 'Entrées')->orWhere('designation', 'Plats principaux')->orWhere('designation', 'Desserts')->orderBy('designation', 'ASC')->get();

        // Si le client est authentifié, on sauvegarde son panier et sa wishlist

        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->id);
            Cart::instance('wishlist')->store(Auth::user()->id);
        }

        return view('frontend.livewire.menu-component', compact('menus', 'categories'));
    }
}
