<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{

    // Propriété qui va nous permettre de savoir si dans un panier il y a un menu

    public $menuIsAbsent =  true;

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
        $verify = false; // Variable locale booléenne qui va nous servire à vérfier si il y a au moins un menu dans le panier
        $item = Cart::instance('cart')->get($rowId);
        $qty = $item->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-icon-component', 'refreshComponent');

        //Losque la quantité d'un produit se trouvant dans la panier est décrémentée jusqu'à 0, ce produit est enlevé du panier
        // On doit vérifier s'il y a encore de menu dans le panier.
        if ($qty == 0) {
            foreach (Cart::instance('cart')->content() as $content) {
                if ($content->associatedModel == "App\Models\Menu") {
                    $verify = true;
                }
            }

            // Lorsque la variable $verify reste à false, cela veut dire qu'il n'y a plus de menu dans le panier

            if ($verify == false  && Auth::user()->firstname != 'Generic') {
                // Dans ce cas, on vide complètement en detruisant l'instance 'cart' en appelant la méthode clearCart()

                $this->clearCart();
            }
            session()->flash('success_message', 'Le produit enlevé de votre panier');
            return redirect()->back();
        }
    }

    public function destroy($rowId)
    {
        $verify =  false;  // Variable locale booléenne qui va nous servire à vérfier si il y a au moins un menu dans le panier
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-icon-component', 'refreshComponent');

        // Lorsqu'on enlève un produit du panier, on vérifier si dans le panier il y a encore des menus

        foreach (Cart::instance('cart')->content() as $content) {
            if ($content->associatedModel == "App\Models\Menu") {
                $verify = true;
            }
        }

        // Lorsque la variable $verify reste à false, cela veut dire qu'il n'y a plus de menu dans le panier

        if ($verify == false && Auth::user() != null && Auth::user()->firstname != 'Generic') {
            // Dans ce cas, on vide complètement en detruisant l'instance 'cart' en appelant la méthode clearCart()
            $this->clearCart();
        }
        session()->flash('success_message', 'Le produit enlevé de votre panier');
        return redirect()->back();
    }

    // Méthode pour vider le panier

    public function clearCart()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Votre panier a été complètement vidé');
        return redirect()->back();
    }

    // Méthode appelée lorque le restautant est fermé.

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

        /**
         * Lorsque le restaurant n'est pas oouvert, on empêche le client d'accéder au panier
         */

        $currentTime = Carbon::now('Europe/Brussels')->format('H:i');  // Récupération de l'heure courante de la Belgique
        $openTime = '00:00';  // Heure d'ouverture
        $closeTime = '23:59';  // Heure de fermeture

        if ($currentTime >= $openTime && $currentTime <= $closeTime) {
            return view('frontend.livewire.cart-component');
        } else {
            // La méthode closeDoors() vide le panier au cas on y aurait ajouté un produit avant la fermeture
            // et redirige le client vers le menu

            $this->closedDoors();
        }

        return view('frontend.livewire.cart-component');
    }
}
