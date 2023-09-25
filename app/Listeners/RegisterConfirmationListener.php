<?php

namespace App\Listeners;

use App\Mail\AmaniRestaurantMail;
use Illuminate\Support\Facades\Mail;
use App\Events\RegisterConfirmationEvent;

class RegisterConfirmationListener
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
    public function handle(RegisterConfirmationEvent $event): void
    {
        // On envoit un e-mail confirmant l'activation du compte

        $subject = "Confirmation de l'activation de votre compte";
        $message = "Bonjour, <br><br> Bravo, votre compte a été activé ou ré-activer avec succès.<br> Vous pouvez maintenant vous connecter avec vos identifiants (adresse e-mail, mot de passe).<br>À bientôt pour profiter de nos délicieux menus!<br><br> Cordialement, <br><br> Amani Resto.";
        $view = 'mails.amanimail';
        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));

    }
}
