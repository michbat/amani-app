<?php

namespace App\Listeners;

use App\Events\OrderPendingEvent;
use App\Mail\AmaniRestaurantMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPendingListener
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
    public function handle(OrderPendingEvent $event): void
    {
        $subject = "Votre commande en préparation";
        $message = "Bonjour,<br><br>";
        $message .= "Votre commande est en préparation. Vous ne pouvez plus l'annuler.<br>";
        $message .= "Nous informerons dès qu'elle est prête.<br><br>";
        $message .= "Cordialement, <br><br>Amani Resto.";
        $view = 'mails.amanimail';

        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));
    }
}
