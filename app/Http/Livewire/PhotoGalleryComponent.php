<?php

namespace App\Http\Livewire;

use App\Models\Gallery;
use Livewire\Component;
use App\Enums\GalleryType;

class PhotoGalleryComponent extends Component
{
    // Lorsqu'il n'y qu'une seule page de plats, on cache la pagination

    public $hideOnSinglePage = true;

    // On utilise la pagination de bootstrap

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $photos = Gallery::where('galleryType', GalleryType::PHOTO->value)->paginate(16);
        return view('frontend.livewire.photo-gallery-component', compact('photos'));
    }
}
