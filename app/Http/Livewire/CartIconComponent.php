<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class CartIconComponent extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

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
