<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Band;
use App\Models\Show;
use App\Models\Music;
use Livewire\Component;
use Livewire\WithPagination;

class ShowComponent extends Component
{
    // On va utiliser la pagination dans le rendu de la page

    use WithPagination;
    // Lorsqu'il n'y qu'une seule page de plats, on cache la pagination

    public $hideOnSinglePage = true;

    // On utilise la pagination de bootstrap

    protected $paginationTheme = 'bootstrap';

    public $startDate;
    public $endDate;
    public $music_id;
    public $band_id;
    public $show;



    public function mount()
    {
        $this->music_id = 0;
    }

    public function updated()
    {
        $this->resetPage();
    }


    public function render()
    {
        //  Objet "query" sert à construire une requête Eloquent qui sera utilisée pour récupérer les enregistrement de la table "shows"
        // en fonction des critères de filtrage

        $query = Show::query();  // Création d'un objet de requête Eloquent à partir de la classe modèle "Show"

        // Si l'utilisateur choisit un interval de dates

        if ($this->startDate && $this->endDate) {
            $start = $this->startDate;
            $end = $this->endDate;

            // Je choisis des shows qui ont des représentations (un show peut avoir plusieurs représentation- voir l'analyse)

            $query->whereHas('representations', function ($q) use ($start, $end) {
                $q->whereBetween('representationDate', [$start, $end]);
            });
        }

        // Filtrage par style de musique

        if ($this->music_id) {
            $query->whereHas('band.musics', function ($q) {
                $q->where('musics.id', $this->music_id);
            });
        }

        // Filtrage par nom du show

        if (!empty($this->show)) {
            $query->where('title', 'like', '%' . $this->show . '%');
        }

        // Filtrage par nom de groupe


        if($this->band_id)
        {
            $query->whereHas('band', function ($q) {
                $q->where('bands.id', $this->band_id);
            });

        }
        // La méthode paginate() permet de paginer dans la vue nos résultats

        $shows = $query->orderBy('shows.id', 'DESC')->paginate(4);

        // Je sélectionne des styles de musique et les groupes de musique puisqu'il y a des filtres sur ces 2 éléments

        $musics = Music::orderBy('style')->get();
        $bands = Band::orderBy('name')->get();

        return view('frontend.livewire.show-component', compact('shows', 'musics','bands'));
    }
}
