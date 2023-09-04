<?php

namespace App\Listeners;

use App\Mail\AmaniRestaurantMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReviewPublishedListenerEvent
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
    public function handle(object $event): void
    {
        $subject = "Votre commentaire a été publiée";
        $message = "Bonjour,<br><br>";
        $message .= "Votre commentaire a été publiée. Merci de votre contribution!<br><br>";
        $message .= "Cordialement, <br><br>Amani Resto.";
        $view = 'mails.account_activation_mail';

        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));
    }
}
