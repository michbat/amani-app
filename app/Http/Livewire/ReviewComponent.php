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


        $review = new Review();

        $review->rating = $this->rating;
        $review->title = $this->title;
        $review->comment = $this->comment;
        $review->user_id = $this->user_id;
        $review->menu_id = $this->menu->id;

        $review->save();

        return redirect()->route('details', $this->menu->slug)->with('success', 'Nous avons bien reçu votre commentaire. Il sera publié après l\'évaluation de nos modérateurs');
    }
    public function render()
    {
        $menu = $this->menu;
        return view('frontend.livewire.review-component', compact('menu'));
    }
}
