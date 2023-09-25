<?php

namespace App\Listeners;

use App\Events\ResetPasswordConfirmationEvent;
use App\Mail\AmaniRestaurantMail;
use Illuminate\Support\Facades\Mail;

class ResetPasswordConfirmationListener
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
    public function handle(ResetPasswordConfirmationEvent $event): void
    {
        // On envoit un e-mail confirmant le reset du mot de passe

        $subject = "Confirmation du changement de votre mot de passe";
        $message = "Bonjour, <br><br>Votre mot de passé a été mis à jour avec succès.<br> Vous pouvez maintenant vous connecter avec vos identifiants (adresse e-mail, mot de passe).<br>À bientôt pour profiter de nos délicieux menus!<br><br> Cordialement, <br><br> Amani Resto.";
        $view = 'mails.amanimail';
        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));

    }
}
