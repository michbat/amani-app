<?php

namespace App\Listeners;

use App\Events\ResentLinkSubmitEvent;
use App\Mail\AmaniRestaurantMail;
use Illuminate\Support\Facades\Mail;

class ResentLinkSubmitListener
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
    public function handle(ResentLinkSubmitEvent $event): void
    {
        // On envoit à nouveau un lien pour renouveler le mot de passe.

        $reset_link = url('reset-password/' . $event->user->token . '/' . $event->user->email);
        $subject = 'Changement de votre mot de passe';
        $message = 'Bonjour, <br><br>Veuillez cliquer sur ce lien pour changer votre mot de passe: <a href="' . $reset_link . '">Cliquez ici</a>';
        $message .= '<br><br>Cordialement,<br><br>Amani Resto.';
        $view = 'mails.account_activation_mail';

        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));

    }
}
