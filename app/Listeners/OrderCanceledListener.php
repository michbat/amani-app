<?php

namespace App\Listeners;

use App\Mail\AmaniRestaurantMail;
use App\Events\OrderCanceledEvent;
use Illuminate\Support\Facades\Mail;

class OrderCanceledListener
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
    public function handle(OrderCanceledEvent $event): void
    {
        $subject = "Votre commande a été annulée";
        $message = "Bonjour,<br><br>";
        $message .= "Par la présente, nous vous informons de l'annulation de votre commande<br>";
        $message .= "Nous allons procéder au remboursement.<br><br>";
        $message .= "Cordialement, <br><br>Amani Resto.";
        $view = 'mails.amanimail';

        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));
    }
}
