<?php

namespace App\Http\Livewire;

use App\Models\Plat;
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

    // Méthode pour ajouter un plat dans le panier à partir de la wishlist

    public function storePlat($plat_id, $plat_name, $plat_price)
    {
        if (!Auth::user() || Auth::user()->firstname !== 'Generic') {

            if (Cart::instance('cart')->content()->count() > 0) {

                foreach (Cart::instance('cart')->content() as $content) {
                    $plat = Plat::where('name', $plat_name)->first();

                    $ingredients = $plat->ingredients;

                    foreach ($ingredients as $ingredient) {
                        if ((($ingredient->quantityInStock / 3) - ($ingredient->pivot->amount * $content->qty)) <= $ingredient->quantityMinimum) {
                            session()->flash('warning_message', 'Vous ne pouvez plus ajouter ce plat. Stock limité.');
                            return redirect()->back();
                        }
                    }

                    if ($content->associatedModel == 'App\Models\Plat' && $content->id == $plat_id && $content->qty >= 6) {
                        session()->flash('warning_message', 'Vous avez déjà 6 articles de ce plat dans le panier! Impossible d\'en ajouter encore un!');
                        return redirect()->back();
                    }
                }
            } else {
                $plat = Plat::where('name', $plat_name)->first();

                $ingredients = $plat->ingredients;

                foreach ($ingredients as $ingredient) {
                    if ((($ingredient->quantityInStock / 3) - $ingredient->pivot->amount) <= $ingredient->quantityMinimum) {
                        session()->flash('warning_message', 'Vous ne pouvez plus ajouter ce plat. Stock limité.');
                        return redirect()->back();
                    }
                }
            }

            // Si la limite n'a pas été atteinte, on ajoute le produit dans le panier

            Cart::instance('cart')->add($plat_id, $plat_name, 1, $plat_price)->associate('App\Models\Plat');

            $this->emitTo('cart-icon-component', 'refreshComponent');

            // Si le plat est ajouté de la carte, on l'efface de la wishlist, faisant appel à la méthode removePlatToWishList()

            $this->removePlatToWishList($plat_id);

            session()->flash('success_message', 'Plat ajouté dans votre panier et retiré de la wishlist');
            return redirect()->back();
        }

    }

    public function render()
    {
        // Si l'utilisateur authentifié  n'est pas 'Generic', on sauvegarde son panier et sa wishlist

        if (Auth::check() && Auth::user()->firstname !== 'Generic') {
            Cart::instance('cart')->store(Auth::user()->id);
            Cart::instance('wishlist')->store(Auth::user()->id);
        }

        // Si l'utilisateur connecté est 'Generic', on sauvegarde uniquement son panier

        if (Auth::check() && Auth::user()->firstname === 'Generic') {
            Cart::instance('cart')->store(Auth::user()->id);
        }

        return view('frontend.livewire.wishlist-component');
    }
}
