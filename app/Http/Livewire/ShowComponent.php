<?php

namespace App\Http\Livewire;

use App\Models\Show;
use Livewire\Component;

class ShowComponent extends Component
{
    // Lorsqu'il n'y qu'une seule page de plats, on cache la pagination

    public $hideOnSinglePage = true;

    // On utilise la pagination de bootstrap

    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $shows = Show::orderBy('id', 'DESC')->paginate(4);
        return view('frontend.livewire.show-component', compact('shows'));
    }
}
