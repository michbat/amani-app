<?php

namespace App\Http\Livewire;

use App\Models\Gallery;
use Livewire\Component;
use App\Enums\GalleryType;

class VideoGalleryComponent extends Component
{
    // Lorsqu'il n'y qu'une seule page de plats, on cache la pagination

    public $hideOnSinglePage = true;

    // On utilise la pagination de bootstrap

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $videos = Gallery::where('galleryType', GalleryType::VIDEO->value)->paginate(16);
        // dd($videos);
        return view('frontend.livewire.video-gallery-component', compact('videos'));
    }
}
