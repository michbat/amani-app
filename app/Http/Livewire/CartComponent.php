<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartComponent extends Component
{

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function increaseQuantity($rowId)
    {
        $menu = Cart::get($rowId);
        $qty = $menu->qty + 1;
        Cart::update($rowId, $qty);
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }
    public function decreaseQuantity($rowId)
    {
        $menu = Cart::get($rowId);
        $qty = $menu->qty - 1;
        Cart::update($rowId, $qty);
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }

    public function destroy($rowId)
    {
        Cart::remove($rowId);
        $this->emitTo('cart-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Le menu a été enlevé de votre panier');
    }
    public function clearCart()
    {
        Cart::destroy();
        $this->emitTo('cart-icon-component', 'refreshComponent');
        return redirect()->route('menu')->with('success', 'Votre panier a été complètement vidé');
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
        return view('frontend.livewire.cart-component');
    }
}
