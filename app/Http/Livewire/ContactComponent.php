<?php

namespace App\Http\Livewire;


use Livewire\Component;
use App\Mail\AmaniRestaurantMail;
use Illuminate\Support\Facades\Mail;

class ContactComponent extends Component
{

    public $name, $email, $message, $verify, $question;

    protected $messageValidationRules = [
        'name' => 'required|min:2|max:255',
        'email' => 'required|email',
        'message' => 'required|max:10000',
        'verify' => 'required|human_verification',
    ];

    public function mount()
    {

        // Le résultat du test 'robot' consiste à trouver la solution d'une addition entre deux nombre entiers (enrre 1 et 10)
        // générés aléatoirement. Le test est lancé au chargement de la page d'où l'utilisation de la méthode mount()

        $number1 =  rand(1, 10);
        $number2 =  rand(1, 10);

        $result =  $number1 + $number2;

        // La propriété question contient la question qui sera affiché dans la propriété placeholder de l'input dans la vue

        $this->question =  "Êtes-vous un être humain ? {$number1} + {$number2} = ";

        // On sauvegarde la résultat dans une variable de session pour pouvoir le comparer à la réponse de l'utilisateur

        session(['test_answer' => $result]);
    }

    public function sendMessage()
    {
        $this->validate($this->messageValidationRules, [
            'name.required' => 'Veuillez indiquer votre nom et prénom SVP',
            'name.min' => '2 caractères au minimum',
            'name.max' => '255 caractères au maximum',
            'email.required' => 'L\'email est requise',
            'email.email' => 'Veuillez entrer une vraie adresse email',
            'message.required' => 'Le message est requis',
            'message.max' => 'Votre message est très long! Il doit comporter 10000 caractères au maximum!',
            'verify.required' => 'Veuillez répondre à la question de vérification',

            // La règle de validation 'human_verification' a été défini dans le fichier app/Providers/AppServiceProvider.php
            'verify.human_verification' => 'La réponse à la question de vérification est incorrecte',
        ]);

        $subject = "Message provenant de la page de contact";
        $message = $this->message;
        $message .= "<br><br><b>Envoyeur:</b> $this->name";
        $view = 'mails.account_activation_mail';

        $response = Mail::to($this->email)->send(new AmaniRestaurantMail($subject, $message, $view));

        // Si l'envoi du message est un échec

        if (!$response) {
            return redirect()->back()->with('warning', 'Votre message n\'a pas été envoyé. Veuillez re-essayer');
        }

        return redirect()->route('home')->with('success', 'Nous avons reçu votre message. Nous vous répondrons dans les plus brefs délais');
    }


    public function render()
    {
        return view('frontend.livewire.contact-component');
    }
}
