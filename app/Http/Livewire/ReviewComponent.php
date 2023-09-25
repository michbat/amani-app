<?php

namespace App\Http\Livewire;

use App\Models\Plat;
use App\Models\Review;
use Livewire\Component;


class ReviewComponent extends Component
{
    public $slug;
    public $user_id;
    public $plat;
    public $title, $comment;
    public $rating;
    public $alreadyCommented;

    // Règles de validation

    protected $reviewValidationRules = [
        'title' => 'required|max:30',
        'comment' => 'required|max:300',
        'rating' => 'required',
    ];


    public function mount($slug, $user)
    {
        $this->slug = $slug;
        $this->user_id = $user;
        $this->plat = Plat::where('slug', $this->slug)->first();

        // Je vérifie que si le client a déjà commenté ce plat auquel cas, il n'a plus droit de le commenter.

        $this->alreadyCommented =  Review::where('user_id', $this->user_id)->where('plat_id', $this->plat->id)->first();

        // Si c'est le cas (si l'objet éloquent renvoyé lors de la requête n'est pas null, on crée un message flash à destination du client)
        if ($this->alreadyCommented != null) {
            session()->flash('warning_message', 'Vous avez déjà commenté ce plat. Vous ne pouvez pas commenter un produit plus d\'une fois.');
        }

    }

    public function updated($fields)
    {
        $this->validateOnly(
            $fields,
            [
                'title' => 'required|max:30',
                'comment' => 'required|max:300',
                'rating' => 'required',
            ],
            [
                'title.required' => 'Le titre est requis',
                'title.max' => 'Le titre doit comporter 30 caractères au maximum',
                'comment.required' => 'Vous devez saisir un commentaire',
                'comment.max' => 'Votre commentaire ne doit pas dépasser 300 caractères',
                'rating.required' => 'Vous devez donner une évaluation'

            ]
        );
    }

    public function postReview()
    {
        $this->validate($this->reviewValidationRules, [
            'title.required' => 'Le titre est requis',
            'title.max' => 'Le titre doit comporter 30 caractères au maximum',
            'comment.required' => 'Vous devez saisir un commentaire',
            'comment.max' => 'Votre commentaire ne doit pas dépasser 300 caractères',
            'rating.required' => 'Vous devez donner une évaluation'
        ]);


        // Si ce n'est que lorsque le client n'a pas déjà commenté le plat que l'on va sauvegarder son message.

        if ($this->alreadyCommented == null) {
            $review = new Review();

            $review->rating = $this->rating;
            $review->title = $this->title;
            $review->comment = $this->comment;
            $review->user_id = $this->user_id;
            $review->plat_id = $this->plat->id;
            $review->save();

            session()->flash('success_message', 'Nous avons reçu votre avis. Il est en cours d\'examen par notre équipe de modérateurs avant publication.');
            return redirect()->route('details', $this->slug);  // On revient à la vue 'details'
        }
    }
    public function render()
    {
        $plat = $this->plat;
        return view('frontend.livewire.review-component', compact('plat'));
    }
}
