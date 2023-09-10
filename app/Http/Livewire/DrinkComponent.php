<?php

namespace App\Http\Livewire;

use App\Models\Drink;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class DrinkComponent extends Component
{
    use WithPagination;


    public $hideOnSinglePage = true;
    protected $paginationTheme = 'bootstrap';


    // Propriété pour afficher le nombre de boissons par page

    public $pageItems = 8;

    // Propriétés pour ordonner les boissons  par prix croissant ou décroissant, nouveauté, défaut
    public $orderBy = "default";

    // Propriétés pour filtrer les boissons par intervalles de prix

    public $priceIntervals = [];

    // Propriété pour filtrer par catégories

    public $cats = [];

    // Propriété pour actver ou désactiver le bouton ajouter en fonction de la plage d'horaire autorisée

    public $canBeCommended;

    /**
     *
     * La méthode updated() est appelée lorsqu'une propriété de notre composant est mise à jour
     * via les interactions de l'utilisateur dans la vue associé à DrinkComponent.
     * Ici on reset l'ancienne pagination générée d'une ancienne recherche pour laisser la place à une nouvelle pagination
     *
     */
    public function updated()
    {
        $this->resetPage();
    }

    // Méthode pour ajouter une boisson dans le panier

    public function storeDrink($drink_id, $drink_name, $drink_price)
    {
        Cart::instance('cart')->add($drink_id, $drink_name, 1, $drink_price)->associate('App\Models\Drink');
        $this->emitTo('cart-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Boisson ajoutée dans votre panier');
        return redirect()->route('cart');
    }

    public function render()
    {
        // La méthode statique query() permet de préparer notre objet $query aux prochaines requêtes eloquent en vue de filtrages

        $query = Drink::query();

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
                $query->orderBy('id', 'DESC');
                break;
            default:
                //
        }

        // Affichage du nombre de produits par page (4,8,12,16,20)

        $drinks = $query->paginate($this->pageItems);

        $categories = Category::where('designation', 'Vins')->orWhere('designation', 'Softs')->orWhere('designation', 'Eaux')->orWhere('designation', 'Bières')->orderBy('designation', 'ASC')->get();

        // Si le client est authentifié, il peut sauvegarde son panier et sa wishlist

        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->id);
            Cart::instance('wishlist')->store(Auth::user()->id);
        }

        return view('frontend.livewire.drink-component', compact('drinks', 'categories'));
    }
}
