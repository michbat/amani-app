<?php

namespace App\Listeners;

use App\Mail\AmaniRestaurantMail;
use App\Events\OrderCompletedEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCompletedListener
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
    public function handle(OrderCompletedEvent $event): void
    {
        $subject = "Votre commande est prête";
        $message = "Bonjour,<br><br> Par la présente, nous vous informons que votre commande est prête.<br>";
        $message .= "Vous avez 1h30 pour la récupérer à notre restaurant. Au délà de ce temps, votre commande sera considérée comme annulée et ce,à votre detriment.<b>Vous ne serez pas remboursé si vous ne venez pas récupérer votre commande.</b><br>";
        $message .= "Cordialement, <br><br>Amani Resto.";
        $view = 'mails.account_activation_mail';

        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));
    }
}
