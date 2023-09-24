<?php

namespace App\Http\Livewire;

use App\Models\Drink;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class DetailsDrinkComponent extends Component
{
    public $drink;
    public $slug;
    public $quantity;

    public function mount($slug)
    {
        // On affiche les informations détaillés d'une boisson en récupérant son slug et en faisant une requête eloquent pour le récupèrer

        $this->slug = $slug;
        $this->drink = Drink::where('slug', $this->slug)->first();

        /**
         * On récupère un objet cart de type Cart (panier) car nous voudrions offrir la possibilité au client de rajouter
         * Une boisson à partir de la page d'informations détaillées. Toutefois, la quantité d'une boisson à ajouter dans un panier étant limitée à 10
         * Nous devons empêcher son ajout dans le panier si cette quantité est atteinte. Nous allons desactiver le bouton "ajouter"
         */
        $cartInstance = Cart::instance('cart');
        $drinkId = $this->drink->id;

        // dd($drinkId);

        // On récupère une boisson ($item) présente dans le panier en comparant des id.

        $item = $cartInstance->search(function ($cartItem) use ($drinkId) {
            return $cartItem->id === $drinkId && $cartItem->associatedModel == 'App\Models\Drink';
        });


        /**
         * Si le produit que l'on veut voir en détails se trouve dans le panier alors on affecte sa quantité à la propriété $quantity bindée (liée)
         * dans la vue "details-component.blade.php" (wire:model="$quantity"). Sinon on lui affecte la valeur zéro.
         */

        $item->first() != null ? $this->quantity = $item->first()->qty :  $this->quantity = 0;
    }

    // Méthode pour ajouter un menu dans le panier
    public function storeDrink($drink_id, $drink_name, $drink_price)
    {
        Cart::instance('cart')->add($drink_id, $drink_name, 1, $drink_price)->associate('App\Models\Drink');
        $this->quantity += 1;
        $this->emitTo('cart-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Boisson ajoutée dans votre panier');
        return redirect()->back();
    }

    // Méthode pour ajouter un menu dans une wishlist

    public function addDrinkToWishList($drink_id, $drink_name, $drink_price)
    {
        Cart::instance('wishlist')->add($drink_id, $drink_name, 1, $drink_price)->associate('App\Models\Drink');
        $this->emitTo('wishlist-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Boisson ajoutée à votre liste de souhaits');
        return redirect()->back();
    }

    // Méthode pour enlèver un menu de la wishlist

    public function removeDrinkToWishList($drink_id)
    {
        foreach (Cart::instance('wishlist')->content() as $content) {
            if ($content->id == $drink_id) {
                Cart::instance('wishlist')->remove($content->rowId);
                $this->emitTo('wishlist-icon-component', 'refreshComponent');
                session()->flash('success_message', 'Boisson enlevée de votre liste de souhaits');
                return redirect()->back();
            }
        }
    }

    public function render()
    {
        $drink = $this->drink;


        // Si l'utilisateur authentifié  n'est pas 'Generic', on sauvegarde son panier et sa wishlist

        if (Auth::check() && Auth::user()->firstname !== 'Generic') {
            Cart::instance('cart')->store(Auth::user()->id);
            Cart::instance('wishlist')->store(Auth::user()->id);
        }

        // Si l'utilisateur connecté est 'Generic', on sauvegarde uniquement son panier

        if (Auth::check() && Auth::user()->firstname === 'Generic') {
            Cart::instance('cart')->store(Auth::user()->id);
        }


        return view('frontend.livewire.details-drink-component', compact('drink'));
    }
}
