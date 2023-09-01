<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistComponent extends Component
{
    // Méthode pour enlèver un menu de la wishlist

    public function removeMenuToWishList($menu_id)
    {
        foreach (Cart::instance('wishlist')->content() as $content) {
            if ($content->id == $menu_id) {
                Cart::instance('wishlist')->remove($content->rowId);
                $this->emitTo('wishlist-icon-component', 'refreshComponent');

                return redirect()->route('wishlist')->with('success', 'Menu enlevé de votre wishlist');
            }
        }
    }

    // Méthode pour ajouter un menu dans le panier

    public function storeMenu($menu_id, $menu_name, $menu_price)
    {
        Cart::instance('cart')->add($menu_id, $menu_name, 1, $menu_price)->associate('App\Models\Menu');
        $this->emitTo('cart-icon-component', 'refreshComponent');

        // Si le menu est ajouté de la carte, on l'efface de la wishlist, faisant appel à la méthode removeMenuToWishList()

        $this->removeMenuToWishList($menu_id);

        // session()->flash('success_message', 'Menu ajouté dans votre panier et retiré de la wishlist');
        return redirect()->route('wishlist')->with('success', 'Menu ajouté dans votre panier et retiré de la wishlist');
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
