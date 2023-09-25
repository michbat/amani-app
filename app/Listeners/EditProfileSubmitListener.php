<?php

namespace App\Listeners;

use App\Mail\AmaniRestaurantMail;
use Illuminate\Support\Facades\Mail;
use App\Events\EditProfileSubmitEvent;

class EditProfileSubmitListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EditProfileSubmitEvent $event): void
    {
        // Création et envoie par mail du lien de vérification et d'activation du compte du nouveau utilisateur enregistré dans la BDD.

        $verification_link = url('register-verify/' . $event->user->token . '/' . $event->user->email);

        $subject = 'Re-activation de votre compte';
        $message = 'Bonjour,<br><br>Veuillez cliquer sur ce lien pour re-activer votre compte: ';
        $message .= '<a href= "' . $verification_link . '">Cliquez ici</a><br>';
        $message .= 'Sans vérification de votre nouvelle adresse e-mail, votre compte restera désactivé.';
        $message .= '<br><br> Cordialement, <br><br> Amani Resto.';
        $view = 'mails.amanimail'; // Lien vers la vue contenant l'email

        // Envoi de l'email.

        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));
    }
}

