<?php

namespace App\Listeners;

use App\Mail\AmaniRestaurantMail;
use App\Events\OrderPickedUpEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPickedUpListener
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
    public function handle(OrderPickedUpEvent $event): void
    {
        $subject = "Votre commande a été récupérée";
        $message = "Bonjour,<br><br>";
        $message .= "Nous vous informons que votre commande a été récupérée.<br>";
        $message .= "Au plaisir de vous revoir la prochaine fois.<br><br>";
        $message .= "Cordialement, <br><br>Amani Resto.";
        $view = 'mails.amanimail';

        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));
    }
}
