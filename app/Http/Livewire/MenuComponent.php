<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Menu;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class MenuComponent extends Component
{
    use WithPagination;

    public $hideOnSinglePage = true;
    protected $paginationTheme = 'bootstrap';

    // Propriété pour afficher le nombre de menus par page

    public $pageItems = 8;

    // Propriétés pour ordonner les menus par prix croissant ou décroissant, nouveauté, défaut
    public $orderBy = "default";

    // Propriétés pour filtrer les menus par intervalles de prix

    public $priceIntervals = [];

    // Propriété pour filtrer par catégories

    public $cats = [];

    public function updated()
    {
        $this->resetPage();
    }

    public function store($menu_id, $menu_name, $menu_price)
    {
        Cart::add($menu_id, $menu_name, 1, $menu_price)->associate('App\Models\Menu');
        session()->flash('success_message', 'Menu ajouté dans votre panier');
        return redirect()->route('cart');

    }

    public function render()
    {
        // La méthode statique query() permet de préparer notre objet $query aux prochaines requêtes eloquent en vue de filtrages

        $query = Menu::query();

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

        // Ordonner nos menus par prix, nouveauté (ordre d'enregistrement dans la BDD)

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
            default:
                //
        }

        // Affichage du nombre de produits par page (4,8,12,16,20)

        $menus = $query->paginate($this->pageItems);

        $categories = Category::orderBy('designation', 'ASC')->get();

        return view('frontend.livewire.menu-component', compact('menus', 'categories'));
    }

}
