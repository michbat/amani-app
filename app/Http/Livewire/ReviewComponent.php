<?php

namespace App\Http\Livewire;


use App\Models\Menu;
use App\Models\Review;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class ReviewComponent extends Component
{
    public $slug;
    public $user_id;
    public $menu;
    public $title, $comment, $rating;
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
        $this->menu = Menu::where('slug', $this->slug)->first();

        // Je vérifie que si le client a déjà commenté ce menu auquel cas, il n'a plus droit de le commenter.

        $this->alreadyCommented =  Review::where('user_id', $this->user_id)->where('menu_id', $this->menu->id)->first();

        // Si c'est le cas (si l'objet éloquent renvoyé lors de la requête n'est pas nul, on crée un message flash à destination du client)
        if ($this->alreadyCommented != null) {
            session()->flash('warning_message', 'Vous avez déjà commenté ce menu. Vous ne pouvez pas commenter un produit plus d\'une fois.');
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


        // Si ce n'est que lorsque le client n'a pas commenté une seule un menu que l'on va sauvegarder son message.

        if ($this->alreadyCommented == null) {
            $review = new Review();

            $review->rating = $this->rating;
            $review->title = $this->title;
            $review->comment = $this->comment;
            $review->user_id = $this->user_id;
            $review->menu_id = $this->menu->id;
            $review->save();

            session()->flash('success_message','Votre avis a été ajouté avec succès! Il est en cours d\'examen par notre équipe de modérateurs avant publication.');
            return redirect()->route('details',$this->slug);  // On revient à la vue 'details'
        }
    }
    public function render()
    {
        $menu = $this->menu;
        return view('frontend.livewire.review-component', compact('menu'));
    }
}
