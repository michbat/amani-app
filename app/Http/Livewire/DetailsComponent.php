<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class DetailsComponent extends Component
{

    public $quantity = 1;
    public $menu;
    public function mount($id)
    {
        $this->id = $id;
        $this->menu = Menu::where('id', $this->id)->first();
    }

    public function increaseQuantity()
    {
        $this->quantity += 1;
    }
    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {

            $this->quantity -= 1;
        }

    }

    public function store($menu_id, $menu_name, $menu_price)
    {
        Cart::add($menu_id, $menu_name, $this->quantity, $menu_price)->associate('App\Models\Menu');
        session()->flash('success_message', 'Menu ajouté dans votre panier');
        return redirect()->route('cart');
    }
    public function render()
    {
        return view('frontend.livewire.details-component', [
            'menu' => $this->menu,
        ]);
    }
}
