<?php

namespace App\Http\Livewire;

use Livewire\Component;


class CartIconComponent extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        return view('frontend.livewire.cart-icon-component');
    }
}
