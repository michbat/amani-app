<?php

namespace App\Listeners;

use App\Mail\AmaniRestaurantMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReviewCensoredListenerEvent
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
        $subject = "Votre commentaire a été réfusé";
        $message = "Bonjour,<br><br>";
        $message .= "Nous sommes dans le regret de vous informer que votre message n'a pas été publié pour propos inconvénants ou hors sujet.<br>Veuillez prendre en considération qu'après 5 messages réfusés, <b>vous ne pouvez plus commenter nos plats</b>.<br>";
        if ($event->user->censoredComments == 5) {
            $message .= "Par conséquent, vous ne pouvez plus commenter sur notre site après 5 messages réfusés.<br><br>";
        } else {
            $message .= "Il vous reste encore " . (5 - $event->user->censoredComments) . " chance(s) !<br><br>";
        }

        $message .= "Cordialement, <br><br>Amani Resto.";
        $view = 'mails.amanimail';

        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));
    }
}
