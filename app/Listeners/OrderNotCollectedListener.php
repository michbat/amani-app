<?php

namespace App\Listeners;

use App\Events\OrderNotCollectedEvent;
use App\Mail\AmaniRestaurantMail;
use Illuminate\Support\Facades\Mail;


class OrderNotCollectedListener
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
    public function handle(OrderNotCollectedEvent $event): void
    {
        $subject = "Commande non-recupérée";
        $message = "Bonjour,<br><br>";
        $message .= "Vous n'êtes pas venu récupérer votre commande. Nous ne conservons pas des commandes prêtes plus de 1h30.<br>";
        $message .= "Par ailleurs, Nous ne faisons pas de remboursement pour des commandes non-récupérées conformement à notre règlement.<br><br>";
        $message .= "Cordialement, <br><br>Amani Resto.";
        $view = 'mails.amanimail';

        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));
    }
}
