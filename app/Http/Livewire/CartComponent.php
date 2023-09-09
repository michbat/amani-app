<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function increaseQuantity($rowId)
    {
        $item = Cart::instance('cart')->get($rowId);
        $qty = $item->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }
    public function decreaseQuantity($rowId)
    {
        $item = Cart::instance('cart')->get($rowId);
        $qty = $item->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-icon-component', 'refreshComponent');

        if ($qty == 0) {
            session()->flash('success_message', 'Le produit enlevé de votre panier');
        }
    }

    public function destroy($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Le produit enlevé de votre panier');
    }
    public function clearCart()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Votre panier a été complètement vidé');
    }

    // Méthode appelé lorque les commandes sont fermées.

    public function closedDoors()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-icon-component', 'refreshComponent');
        return redirect()->route('menu')->with('info', 'Désolé, vous ne pouvez commander qu\'entre 10h00 et 23h00. Merci de votre compréhension.');
    }

    public function checkout()
    {
        // Si la personne qui simule le panier est connecté, on le dirige vers la page Checkout si authentifiée sinon vers la page login
        if (Auth::check()) {
            return redirect()->route('checkout');
        } else {
            return redirect()->route('login')->with('info', 'Vous devez être connecté pour effectuer le paiement');
        }
    }
    public function render()
    {
        // Si le client est authentifié, on sauvegarde son panier et sa wishlist

        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->id);
            Cart::instance('wishlist')->store(Auth::user()->id);
        }

        $currentTime = Carbon::now('Europe/Brussels')->format('H:i');
        $openTime = '10:00';
        $closeTime = '23:00';

        if ($currentTime >= $openTime && $currentTime <= $closeTime) {
            return view('frontend.livewire.cart-component');
        } else {
            $this->closedDoors();
        }

        return view('frontend.livewire.cart-component');
    }
}
