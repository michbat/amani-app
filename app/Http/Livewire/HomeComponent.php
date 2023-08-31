<?php

namespace App\Http\Livewire;

use App\Enums\GalleryType;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\Slider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class HomeComponent extends Component
{

    public function storeMenu($menu_id, $menu_name, $menu_price)
    {
        Cart::instance('cart')->add($menu_id, $menu_name, 1, $menu_price)->associate('App\Models\Menu');
        session()->flash('success_message', 'Menu ajouté dans votre panier');
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

        // On affiche à la page d'accueil les menus les moins chers

        $menus = Menu::orderBy('price', 'ASC')->limit(8)->get();

        // On injecte les objets récupérés dans la vue

        return view('frontend.livewire.home-component', compact('sliders', 'restaurant', 'video', 'menus'));
    }
}
