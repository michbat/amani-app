<?php

namespace App\Listeners;

use App\Events\OrderConfirmedEvent;
use App\Mail\AmaniRestaurantMail;
use Illuminate\Support\Facades\Mail;

class OrderConfirmedListener
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
    public function handle(OrderConfirmedEvent $event): void
    {
        $subject = "Confirmation de votre commande";
        $message = "Bonjour,<br><br> Par la présente, nous confirmons votre commande.<br>";
        $message .= "Vous pouvez suivre l'état de votre commande en vous connectant sur votre compte.<br><br>";
        $message .= "Cordialement, <br><br>Amani Resto.";
        $view = 'mails.account_activation_mail';

        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));
    }
}
