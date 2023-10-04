<?php

namespace App\Listeners;

use App\Mail\AmaniRestaurantMail;
use Illuminate\Support\Facades\Mail;
use App\Events\OrderFailedRefundedEvent;



class OrderFailedRefundedListener
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
    public function handle(OrderFailedRefundedEvent $event): void
    {
        $subject = "Le remboursement de votre commande";
        $message = "Bonjour,<br><br>";
        $message .= "Par la présente, nous vous informons du remboursement de la commande que vous avez annulée<br>";
        $message .= "Nous restons à votre service.<br><br>";
        $message .= "Cordialement, <br><br>Amani Resto.";
        $view = 'mails.amanimail';

        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));
    }
}
