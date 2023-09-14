<?php

namespace App\Http\Livewire;

use App\Models\Restaurant;
use Livewire\Component;

class ReglementComponent extends Component
{
    public function render()
    {
        $restaurant = Restaurant::all()[0];
        return view('frontend.livewire.reglement-component', compact('restaurant'));
    }
}
