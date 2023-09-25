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
        $message .= "Votre commande sera prête au plus tard dans 30 minutes. Un e-mail vous sera envoyé dès qu'elle est prête.<br>";
        $message .= "Veuillez prendre note que vous disposez de <b> 1h30 </b> pour la retirer à notre restaurant après qu'elle soit prête.<br>";
        $message .= "À defaut de ce retrait, votre commande sera considérée comme annulée à votre detriment (aucun remboursement possible).<br>";
        $message .= "Vous avez la possibilité de suivre l'état de votre commande en vous connectant sur votre compte.<br><br>";
        $message .= "Cordialement, <br><br>Amani Resto.";
        $view = 'mails.account_activation_mail';

        Mail::to($event->user->email)->send(new AmaniRestaurantMail($subject, $message, $view));
    }
}
