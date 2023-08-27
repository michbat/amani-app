<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartIconComponent extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function destroy($rowId)
    {
        Cart::remove($rowId);
        $this->emitTo('cart-component', 'refreshComponent');
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
        return view('frontend.livewire.cart-icon-component');
    }
}
