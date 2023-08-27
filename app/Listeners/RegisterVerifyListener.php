<?php

namespace App\Listeners;

use App\Mail\AmaniRestaurantMail;
use App\Events\RegisterVerifyEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterVerifyListener
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
    public function handle(RegisterVerifyEvent $event): void
    {
         // Création et envoie par mail du lien de vérification et d'activation du compte du nouveau utilisateur enregistré dans la BDD.

         $verification_link = url('register-verify/' . $event->user->token . '/' . $event->user->email);

         $subject = 'Activation de votre nouveau compte';
         $message = 'Bonjour, <br><br> Bienvenu(e) sur notre site.<br>Veuillez cliquer sur ce lien pour activer votre compte: ';
         $message .= '<a href= "' . $verification_link . '">Cliquez ici</a> <br><br> Cordialement, <br><br> Amani Resto.';
         $view = 'mails.account_activation_mail'; // Lien vers la vue contenant l'email

         // Envoi de l'email. On met en paramètre de la méthode send() un objet de la classe AmaniRestaurantMail qui reçoit 3 paramètres (voir la classe en question dans le sous-dossier Mail/ du dossier app/)

         Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));

    }
}
