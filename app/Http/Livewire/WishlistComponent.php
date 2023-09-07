<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Models\Drink;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistComponent extends Component
{
    // Méthode pour enlèver un menu de la wishlist

    public function removeItemToWishList($item_id)
    {
        foreach (Cart::instance('wishlist')->content() as $content) {
            if ($content->id == $item_id) {
                Cart::instance('wishlist')->remove($content->rowId);
                $this->emitTo('wishlist-icon-component', 'refreshComponent');

                return redirect()->route('wishlist')->with('success', 'Produit enlevé de votre wishlist');
            }
        }
    }

    // Méthode pour ajouter un menu dans le panier

    public function storeItem($item_id, $item_name, $item_price)
    {
        // On vérifie si l'item que l'on veut transfèrer dans le panier est un menu ou un drink

        $menu = Menu::where('name', $item_name)->first();

        //  Si c'est un menu, on le rajouter dans le panier en l'associant au modèle Menu
        if ($menu) {
            Cart::instance('cart')->add($item_id, $item_name, 1, $item_price)->associate('App\Models\Menu');
        }else{
             //  Si c'est un drink, on le rajouter dans le panier en l'associant au modèle Drink

            Cart::instance('cart')->add($item_id, $item_name, 1, $item_price)->associate('App\Models\Drink');
        }
        $this->emitTo('cart-icon-component', 'refreshComponent');

        // Si le menu est ajouté de la carte, on l'efface de la wishlist, faisant appel à la méthode removeMenuToWishList()

        $this->removeItemToWishList($item_id);

        // session()->flash('success_message', 'Menu ajouté dans votre panier et retiré de la wishlist');
        return redirect()->route('wishlist')->with('success', 'Produit ajouté dans votre panier et retiré de la wishlist');
    }

    public function render()
    {
        // Si le client est authentifié, on sauvegarde son panier et sa wishlist

        if (Auth::check()) {

            Cart::instance('cart')->store(Auth::user()->id);
            Cart::instance('wishlist')->store(Auth::user()->id);
        }

        return view('frontend.livewire.wishlist-component');
    }
}
