<?php

namespace App\Listeners;

use App\Mail\AmaniRestaurantMail;
use App\Events\OrderPickupFailEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPickupFailListener
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
    public function handle(OrderPickupFailEvent $event): void
    {
        $subject = "Votre commande annulée (non-recupération)";
        $message = "Bonjour,<br><br>";
        $message .= "Nous vous informons que votre commande a été annulée faute d'avoir été récupérée 2 heures après sa préparation.<br>";
        $message .= "Malheuresement, aucun remboursement n'est possible conformement à notre règlement.<br><br>";
        $message .= "Cordialement, <br><br>Amani Resto.";
        $view = 'mails.account_activation_mail';

        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));
    }
}
