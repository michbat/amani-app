<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistComponent extends Component
{
    // Méthode pour enlèver un plat de la wishlist

    public function removePlatToWishList($item_id)
    {
        foreach (Cart::instance('wishlist')->content() as $content) {
            if ($content->id == $item_id) {
                Cart::instance('wishlist')->remove($content->rowId);
                $this->emitTo('wishlist-icon-component', 'refreshComponent');

                session()->flash('success_message', 'Plat retiré de la wishlist');
                return redirect()->back();
                // return redirect()->route('wishlist')->with('success', 'Produit enlevé de votre wishlist');
            }
        }
    }

    // Méthode pour ajouter un plat dans le panier

    public function storePlat($plat_id, $plat_name, $plat_price)
    {

        Cart::instance('cart')->add($plat_id, $plat_name, 1, $plat_price)->associate('App\Models\Plat');

        $this->emitTo('cart-icon-component', 'refreshComponent');

        // Si le plat est ajouté de la carte, on l'efface de la wishlist, faisant appel à la méthode removePlatToWishList()

        $this->removePlatToWishList($plat_id);

        session()->flash('success_message', 'Plat ajouté dans votre panier et retiré de la wishlist');
        return redirect()->back();
        // return redirect()->route('wishlist')->with('success', 'Plat ajouté dans votre panier et retiré de la wishlist');
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
