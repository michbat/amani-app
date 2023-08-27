<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

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
        // On récupére la toute dernière commande qui vient d'être effectuée

        $order = Order::latest()->first();
        return view('frontend.livewire.checkout-success-component', compact('order'));
    }
}
