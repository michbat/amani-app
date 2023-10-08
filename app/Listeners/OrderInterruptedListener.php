<?php

namespace App\Listeners;

use App\Mail\AmaniRestaurantMail;
use Illuminate\Support\Facades\Mail;
use App\Events\OrderInterruptedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderInterruptedListener
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
    public function handle(OrderInterruptedEvent $event): void
    {
        $subject = "Commande interrompue";
        $message = "Bonjour,<br><br>";
        $message .= "Par la présente, nous vous informons que votre commande a été interrompue pour des raisons internes au restaurant.<br>";
        $message .= "Vous allez recevoir un remboursement de votre commande.<br>";
        $message .= "Nous restons à votre service.<br><br>";
        $message .= "Cordialement, <br><br>Amani Resto.";
        $view = 'mails.amanimail';

        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));
    }
}
