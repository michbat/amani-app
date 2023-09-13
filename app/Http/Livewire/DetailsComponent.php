<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Models\Review;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class DetailsComponent extends Component
{
    public $menu;
    public $slug;
    public $quantity;

    public function mount($slug)
    {
        // On affiche les informations détaillés d'un menu en récupérant son slug et en faisant une requête eloquent pour le récupèrer
        $this->slug = $slug;
        $this->menu = Menu::where('slug', $this->slug)->first();

        /**
         * On récupère un objet cart de type Cart (panier) car nous voudrions offrir la possibilité au client de rajouter
         * Un menu à partir de la page d'informations détaillées. Toutefois, la quantité d'un menu à ajouter dans un menu étant limitée à 10
         * Nous devons empêcher son ajout dans le panier si cette quantité est atteinte. Nous allons desactiver le bouton "ajouter"
         */
        $cartInstance = Cart::instance('cart');
        $menuId = $this->menu->id;

        // On récupère un menu ($item) présent dans le panier en comparant des id.

        $item = $cartInstance->search(function ($cartItem) use ($menuId) {
            return $cartItem->id === $menuId;
        });


        /**
         * Si le produit que l'on veut voir en détails se trouve dans le panier alors on affecte sa quantité à la propriété $quantity bindée (liée)
         * dans la vue "details-component.blade.php" (wire:model="$quantity"). Sinon on lui affecte la valeur zéro.
         */

        $item->first() != null ? $this->quantity = $item->first()->qty :  $this->quantity = 0;
    }

    // Méthode pour ajouter un menu dans le panier
    public function storeMenu($menu_id, $menu_name, $menu_price)
    {
        Cart::instance('cart')->add($menu_id, $menu_name, 1, $menu_price)->associate('App\Models\Menu');
        session()->flash('success_message', 'Menu ajouté dans votre panier');
        return redirect()->route('cart');
    }

    // Méthode pour ajouter un menu dans une wishlist

    public function addMenuToWishList($menu_id, $menu_name, $menu_price)
    {
        Cart::instance('wishlist')->add($menu_id, $menu_name, 1, $menu_price)->associate('App\Models\Menu');
        $this->emitTo('wishlist-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Menu ajouté à votre liste de souhaits');
        return redirect()->back();
    }

    // Méthode pour enlèver un menu de la wishlist

    public function removeMenuToWishList($menu_id)
    {
        foreach (Cart::instance('wishlist')->content() as $content) {
            if ($content->id == $menu_id) {
                Cart::instance('wishlist')->remove($content->rowId);
                $this->emitTo('wishlist-icon-component', 'refreshComponent');
                session()->flash('success_message', 'Menu enlevé de votre liste de souhaits');
                return redirect()->back();
            }
        }
    }

    public function render()
    {
        $menu = $this->menu;
        $reviews = Review::where('published', 1)->where('censored', 0)->where('menu_id', $this->menu->id)->orderBy('created_at', 'DESC')->get();
        $user = Auth::user();


        $avg = floor($reviews->avg('rating'));

        // Si le client est authentifié, on sauvegarde son panier et sa wishlist

        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->id);
            Cart::instance('wishlist')->store(Auth::user()->id);
        }

        return view('frontend.livewire.details-component', compact('menu', 'reviews', 'user', 'avg'));
    }
}
