<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Events\OrderFailedRefundedEvent;
use Illuminate\Console\Command;

class OrderRefunded extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:refunded';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to refund customer';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        // On récupère les commandes annulées par le client et les commandes interrompue

        $ordersStatusCanceled = Order::where('orderStatus', OrderStatus::CANCELED->value)->get();
        $ordersStatusInterrupted = Order::where('orderStatus', OrderStatus::INTERRUPTED->value)->get();

        foreach ($ordersStatusCanceled as $oc) {
            // Si la commande est payée mais annulée par le client, on lui rembourse
            if ($oc->paymentStatus == PaymentStatus::PAID) {
                $oc->paymentStatus = PaymentStatus::REFUNDED->value;
                $oc->subtotal = 0;
                $oc->tva = 0;
                $oc->total = 0;
                $oc->update();
                event(new OrderFailedRefundedEvent($oc->user));
            }
        }

        // Si la commande est payée mais interrompue, on rembourse le client

        foreach ($ordersStatusInterrupted as $oi) {
            if ($oi->paymentStatus == PaymentStatus::PAID) {
                $oi->paymentStatus = PaymentStatus::REFUNDED->value;
                $oi->subtotal = 0;
                $oi->tva = 0;
                $oi->total = 0;
                $oi->update();
                event(new OrderFailedRefundedEvent($oi->user));
            }
        }
    }
}
