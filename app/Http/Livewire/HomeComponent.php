<?php

namespace App\Http\Livewire;


use App\Models\Plat;
use App\Models\Staff;
use App\Models\Slider;
use App\Models\Gallery;
use Livewire\Component;
use App\Enums\GalleryType;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class HomeComponent extends Component
{

    public function storePlat($plat_id, $plat_name, $plat_price)
    {
        Cart::instance('cart')->add($plat_id, $plat_name, 1, $plat_price)->associate('App\Models\Plat');
        session()->flash('success_message', 'Plat ajouté dans votre panier');
        return redirect()->route('cart');
    }
    public function render()
    {
        // On récupère un tableau de tous les objets sliders
        $sliders = Slider::all();

        // On récupére l'objet restaurant dont le nom est 'Amani' (objet eloquent = enregistrement dans une table)

        $restaurant = Restaurant::where('name', 'Amani')->first();

        // La vidéo de présentation de l'accueil qui se trouve dans la table "galleries" a pour titre 'Amani'

        $video = Gallery::where('galleryType', GalleryType::VIDEO->value)->where('title', 'Amani')->first();

        // On affiche à la page d'accueil les plats les moins chers

        $plats = Plat::orderBy('price', 'ASC')->limit(8)->get();

        // On recupère les membres du staff

        $staffs = Staff::orderBy('name', 'ASC')->get();

        // Si le client est authentifié, il est dirigé vers l'accueil. On restaure son panier et sa wishlist sauvegardés
        // avant le rendu de la vue "home-component"

        if (Auth::check()) {

            Cart::instance('cart')->restore(Auth::user()->id);
            Cart::instance('wishlist')->restore(Auth::user()->id);

            Cart::instance('cart')->store(Auth::user()->id);
            Cart::instance('wishlist')->store(Auth::user()->id);
        }

        // On injecte les objets récupérés dans la vue

        return view('frontend.livewire.home-component', compact('sliders', 'restaurant', 'video', 'plats', 'staffs'));
    }
}
