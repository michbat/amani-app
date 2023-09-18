<?php

namespace App\Http\Livewire;

use App\Models\Plat;
use App\Models\Review;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class DetailsComponent extends Component
{
    public $plat;
    public $slug;
    public $quantity;

    public function mount($slug)
    {
        // On affiche les informations détaillés d'un plat en récupérant son slug et en faisant une requête eloquent pour le récupèrer
        $this->slug = $slug;
        $this->plat = Plat::where('slug', $this->slug)->first();

        /**
         * On récupère un objet cart de type Cart (panier) car nous voudrions offrir la possibilité au client de rajouter
         * Un plat à partir de la page d'informations détaillées. Toutefois, la quantité d'un plat à ajouter dans un plat étant limitée à 10
         * Nous devons empêcher son ajout dans le panier si cette quantité est atteinte. Nous allons desactiver le bouton "ajouter"
         */
        $cartInstance = Cart::instance('cart');
        $platId = $this->plat->id;

        // On récupère un plat ($item) présent dans le panier en comparant des id.

        $item = $cartInstance->search(function ($cartItem) use ($platId) {
            return $cartItem->id === $platId && $cartItem->associatedModel == 'App\Models\Plat';
        });


        /**
         * Si le produit que l'on veut voir en détails se trouve dans le panier alors on affecte sa quantité à la propriété $quantity bindée (liée)
         * dans la vue "details-component.blade.php" (wire:model="$quantity"). Sinon on lui affecte la valeur zéro puisqu'il n'est pas encore dans le panier.
         */

        $item->first() != null ? $this->quantity = $item->first()->qty :  $this->quantity = 0;

        // session()->put('plat','plat_page_visited');
    }

    // Méthode pour ajouter un plat dans le panier
    public function storePlat($plat_id, $plat_name, $plat_price)
    {
        Cart::instance('cart')->add($plat_id, $plat_name, 1, $plat_price)->associate('App\Models\Plat');
        $this->quantity += 1;
        $this->emitTo('cart-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Plat ajouté dans votre panier');
        return redirect()->back();
    }

    // Méthode pour ajouter un plat dans une wishlist

    public function addPlatToWishList($plat_id, $plat_name, $plat_price)
    {
        Cart::instance('wishlist')->add($plat_id, $plat_name, 1, $plat_price)->associate('App\Models\Plat');
        $this->emitTo('wishlist-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Plat ajouté à votre liste de souhaits');
        return redirect()->back();
    }

    // Méthode pour enlèver un plat de la wishlist

    public function removePlatToWishList($plat_id)
    {
        foreach (Cart::instance('wishlist')->content() as $content) {
            if ($content->id == $plat_id) {
                Cart::instance('wishlist')->remove($content->rowId);
                $this->emitTo('wishlist-icon-component', 'refreshComponent');
                session()->flash('success_message', 'Plat enlevé de votre liste de souhaits');
                return redirect()->back();
            }
        }
    }

    public function render()
    {
        $plat = $this->plat;
        $reviews = Review::where('published', 1)->where('censored', 0)->where('plat_id', $this->plat->id)->orderBy('created_at', 'DESC')->get();
        $user = Auth::user();


        $avg = floor($reviews->avg('rating'));  // Moyenne des reviews publiés!

        // Si l'utilisateur authentifié  n'est pas 'Generic', on sauvegarde son panier et sa wishlist

        if (Auth::check() && Auth::user()->firstname !== 'Generic') {
            Cart::instance('cart')->store(Auth::user()->id);
            Cart::instance('wishlist')->store(Auth::user()->id);
        }

        // Si l'utilisateur connecté est 'Generic', on sauvegarde uniquement son panier

        if (Auth::check() && Auth::user()->firstname === 'Generic') {
            Cart::instance('cart')->store(Auth::user()->id);
        }


        return view('frontend.livewire.details-component', compact('plat', 'reviews', 'user', 'avg'));
    }
}
