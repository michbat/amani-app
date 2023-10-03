<?php

namespace App\Listeners;

use App\Events\EditPasswordSubmitEvent;
use App\Mail\AmaniRestaurantMail;
use Illuminate\Support\Facades\Mail;

class EditPasswordSubmitListener
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
    public function handle(EditPasswordSubmitEvent $event): void
    {
        $subject = "Vous avez modifié votre mot de passe";
        $message = "Bonjour,<br><br> Nous confirmons la modification de votre mot de passe par vos soins.<br>";
        $message .= "Veuillez la prochaine fois vous connecter avec votre nouveau mot de passe.<br><br>";
        $message .= "Cordialement, <br><br>Amani Resto.";
        $view = 'mails.amanimail';

        // dd($event->user);

        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));
    }
}
