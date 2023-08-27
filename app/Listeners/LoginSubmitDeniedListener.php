<?php

namespace App\Listeners;

use App\Mail\AmaniRestaurantMail;
use Illuminate\Support\Facades\Mail;
use App\Events\LoginSubmitDeniedEvent;

class LoginSubmitDeniedListener
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
    public function handle(LoginSubmitDeniedEvent $event): void
    {
        $activation_link = url('register-verify/' . $event->user->token . '/' . $event->user->email);
        $subject = "Rappel pour l'activation de votre compte";
        $message = 'Bonjour, <br><br> Bienvenu(e) sur notre site.<br>Veuillez cliquer sur ce lien pour activer votre compte:';
        $message .= '<a href= "' . $activation_link . '">Cliquez ici</a> <br><br> Cordialement, <br><br> Amani Resto.';
        $view = 'mails.account_activation_mail';

        // Envoi de l'email

        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));

    }
}
