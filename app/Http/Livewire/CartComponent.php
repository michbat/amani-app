<?php

namespace App\Http\Livewire;

use App\Models\Restaurant;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{

    // Propriété qui va nous permettre de savoir si dans un panier il y a un plat

    public $platIsAbsent =  true;

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
        $verify = false; // Variable "drapeau" booléenne qui va nous servir à vérfier si il y a au moins un plat dans le panier
        $item = Cart::instance('cart')->get($rowId); // On récupère le produit pour lequel on décremente la quantité
        $qty = $item->qty - 1;  // On réduit la quantité du produit
        Cart::instance('cart')->update($rowId, $qty);  // On met à jour la quantité du produit objet d'une décrémenation
        $this->emitTo('cart-icon-component', 'refreshComponent');  // On rafrachît l'icône panier pour qu'elle tienne compte de la mise à jour du panier

        // S'il n'y a aucun produit dans le panier
        if (count(Cart::instance('cart')->content()) == 0) {
            return redirect()->back(); // On affiche toujours le panier mais sans message flash de session
        } else {
            // Sinon on parcourt le panier pour voir s'il y a au moins un plat
            foreach (Cart::instance('cart')->content() as $content) {
                if ($content->associatedModel == "App\Models\Plat") {
                    $verify = true;
                }
            }
        }

        // Si la personne est un guest qui simule son panier et qu'il n'a plus de plat dans son panier

        if (!Auth::user() && $verify == false) {
            // Dans ce cas, on vide complètement en detruisant l'instance 'cart' en appelant la méthode clearCart()
            Cart::instance('cart')->destroy();
            $this->emitTo('cart-icon-component', 'refreshComponent');
            session()->flash('warning_message', 'Votre panier doit impérativement contenir un plat pour commander des boissons');
            return redirect()->back();
        }

        // Lorsque la variable $verify reste à false, cela veut dire qu'il n'y a plus de plat dans le panier

        if (Auth::user() && Auth::user()->firstname != 'Generic' && $verify == false) {
            // Dans ce cas, on vide complètement le panier en detruisant l'instance 'cart'
            Cart::instance('cart')->destroy();
            $this->emitTo('cart-icon-component', 'refreshComponent');
            session()->flash('warning_message', 'Votre panier doit impérativement contenir un plat pour commander des boissons');
            return redirect()->back();
        }

        session()->flash('success_message', 'Le produit enlevé de votre panier');
        return redirect()->back();
    }

    public function destroy($rowId)
    {
        $verify =  false;  // Une variable "drapeau" locale booléenne qui va nous servir à vérfier si il y a au moins un plat dans le panier
        Cart::instance('cart')->remove($rowId);  // On enlève le produit dont l'identifiant dans le panier est $rowId
        $this->emitTo('cart-icon-component', 'refreshComponent');   // On rafraîchit la petite icône panier (en haut à droite) contenant des produits (boissons & plats) ajoutés

        if (count(Cart::instance('cart')->content()) == 0) {
            return redirect()->back();
        } else {

            // Lorsqu'on enlève un produit du panier, on vérifie si dans ce panier il y a encore des plats, condition sinequanone pour poursuivre sa commande en ligne

            // On parcourt donc l'objet 'cart' c'est à dire notre panier

            foreach (Cart::instance('cart')->content() as $content) {
                if ($content->associatedModel == "App\Models\Plat") {
                    $verify = true;  // S'il y a au moins un plat dans le panier, $verify devient true
                }
            }
        }


        //  Si personne n'est connectée et qu'il n'y a pas de plat dans le panier

        if (!Auth::user() && $verify == false) {
            // Dans ce cas, on vide complètement le panier en detruisant l'instance 'cart'
            Cart::instance('cart')->destroy();
            $this->emitTo('cart-icon-component', 'refreshComponent');
            session()->flash('warning_message', 'Votre panier doit impérativement contenir un plat pour commander des boissons.');
            return redirect()->back();
        }

        // Si la personne est connectée sans être le "generic consummer" en plus d'un panier vide de plat

        if (Auth::user() && Auth::user()->firstname != 'Generic' && $verify == false) {
            // Dans ce cas, on vide complètement le panier en detruisant l'instance 'cart'
            Cart::instance('cart')->destroy();
            $this->emitTo('cart-icon-component', 'refreshComponent');
            session()->flash('warning_message', 'Votre panier doit impérativement contenir un plat pour commander des boissons.');
            return redirect()->back();
        }

        session()->flash('success_message', 'Le produit enlevé de votre panier');
        return redirect()->back();
    }

    // Méthode pour vider le panier en cliquant sur le panier ("vider votre panier")

    public function clearCart()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Votre panier a été complètement vidé');
        return redirect()->back();
    }

    // Méthode appelée lorque le restautant est fermé pour empêcher d'accèder au panier tout ne le vidant (au cas où le client y aurait ajouté un produit avant la fermeture)

    private function closedDoors()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-icon-component', 'refreshComponent');
        return redirect()->route('home')->with('info', 'Désolé, vous ne pouvez commander qu\'entre 10h00 et 23h00. Merci de votre compréhension.');
    }

    private function isOpened()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-icon-component', 'refreshComponent');
        return redirect()->route('home')->with('info', 'Le restaurant est fermé, vous ne pouvez pas commander');
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
        // Si l'utilisateur authentifié  n'est pas 'Generic', on sauvegarde son panier et sa wishlist

        if (Auth::check() && Auth::user()->firstname !== 'Generic') {
            Cart::instance('cart')->store(Auth::user()->id);
            Cart::instance('wishlist')->store(Auth::user()->id);
        }

        // Si l'utilisateur connecté est 'Generic', on sauvegarde uniquement son panier

        if (Auth::check() && Auth::user()->firstname === 'Generic') {
            Cart::instance('cart')->store(Auth::user()->id);
        }



        /**
         * Lorsque le restaurant n'est pas oouvert, on empêche le client d'accéder au panier
         */

        $currentTime = Carbon::now('Europe/Brussels')->format('H:i');  // Récupération de l'heure courante de la Belgique
        $openTime = '23:00';  // Heure d'ouverture
        $closeTime = '23:59';  // Heure de fermeture

        if ($currentTime < $openTime || $currentTime > $closeTime) {
            // On n'appele la méthode closedDoors() en dehors des heures d'ouverture
            $this->closedDoors();
        }

        // Si le restaurant est fermé pour d'autres raisons que les heures d'ouverture

        $opened = Restaurant::all()[0]->opened;   // on récupère la propriété $opened de l'objet de type 'Restauranr'

        if (!$opened) {
            $this->isOpened();
        }



        return view('frontend.livewire.cart-component');
    }
}
