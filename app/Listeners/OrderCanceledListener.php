<?php

namespace App\Listeners;

use App\Mail\AmaniRestaurantMail;
use App\Events\OrderCanceledEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        $message .= "Par la présente, nous vous confirmons l'annulation de votre commande<br>";
        $message .= "Veuillez prendre contact avec nous pour le remboursement.<br><br>";
        $message .= "Cordialement, <br><br>Amani Resto.";
        $view = 'mails.account_activation_mail';

        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));
    }
}
