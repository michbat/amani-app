<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutSuccessComponent extends Component
{
    public function mount()
    {
        // On interdit d'accéder à la vue de composant la session n'a pas de variable 'success' transmise
        // lors de la redirection après passation de commande vers cette page dans la méthode PlaceOrder() du composant CheckoutComponent

        if (!session()->has('success')) {
            return redirect()->route('home')->with('warning', 'Vous n\'avez aucune commande en cours!');
        }
    }

    public function render()
    {
        // On prend la "photographie" du panier et de la wishlist de l'utilisateur connecté qui n'est pas 'Generic'.

        if (Auth::check() && Auth::user()->firstname !== 'Generic') {
            Cart::instance('cart')->store(Auth::user()->id);
            Cart::instance('wishlist')->store(Auth::user()->id);
        }

        session()->forget('acc'); // On détruit la session 'acc' crée dans le composant CheckoutComponent

        // On récupére la toute dernière commande qui vient d'être effectuée

        $order = Order::latest()->first();
        return view('frontend.livewire.checkout-success-component', compact('order'));
    }
}
