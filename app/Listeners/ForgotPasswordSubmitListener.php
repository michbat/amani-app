<?php

namespace App\Listeners;

use App\Mail\AmaniRestaurantMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ForgotPasswordSubmitEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPasswordSubmitListener
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
    public function handle(ForgotPasswordSubmitEvent $event): void
    {
         // Création d'un lien et son envoi par e-mail

         $reset_link = url('reset-password/' . $event->user->token . '/' . $event->user->email);
         $subject = 'Changement de votre mot de passe';
         $message = 'Bonjour, <br><br>Veuillez cliquer sur ce lien pour changer votre mot de passe: <a href="' . $reset_link . '">Cliquez ici</a>';
         $message .= '<br><br>Cordialement,<br><br>Amani Resto.';
         $view = 'mails.account_activation_mail'; // La vue contenant l'email (voir le dossier 'resources/views/mails')

         // Envoi de l'email. On met en paramètre de la méthode send() un objet de la classe AmaniRestaurantMail qui reçoit 3 paramètres (voir la classe en question dans le sous-dossier Mail/ du dossier app/)

         Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));

    }
}
