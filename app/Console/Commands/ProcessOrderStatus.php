<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Enums\OrderStatus;
use Illuminate\Console\Command;
use App\Events\OrderPendingEvent;
use App\Events\OrderCompletedEvent;
use App\Events\OrderPickedUpEvent;
use App\Events\OrderPickupFailEvent;

class ProcessOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process order status';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $onlyDrinkInOrder = true;  // Une variable booléenne "drapeau" qui va confirmer ou infirmer qu'une commande ne contient que des boissons

        // On selectionne des commandes confirmées

        $orders = Order::where('orderStatus', OrderStatus::CONFIRMED->value)
            ->where('created_at', '<=', now()->subSeconds(3))
            ->get();

        //On vérifie que dans ces commandes, il n'y a que des boissons

        foreach ($orders as $order) {

            foreach ($order->lineOrders as $lineOrder) {
                // Si dans les lignes de commandes, il y a au moins une ligne qui contient un memu
                if ($lineOrder->plat_id != '') {
                    $onlyDrinkInOrder = false;  // Notre variable drapeau se met à false
                }
            }

            // Si on n'a aucun plat dans les lignes de commande alors ce qu'on a commandé uniquement des boissonns.
            // Dans ce cas, on met le OrderStatus à récupérée (pickedup) puisque les commandes contenant uniquement des boissons
            // ne peuvent se dérouler qu'à l'intérieur du resto

            if ($onlyDrinkInOrder) {
                if ($orders->count() > 0) {
                    foreach ($orders as $order) {
                        $order->orderStatus = OrderStatus::PICKEDUP->value;
                        $user = $order->user;
                        event(new OrderPickedUpEvent($user));
                        $order->update();
                    }
                }
            }
        }

        $orders = null;


        // Traitements des commandes dans lesquelles il y a au moins un plat


        $ordersToPending = Order::where('orderStatus', OrderStatus::CONFIRMED->value)
            ->where('created_at', '<=', now()->subMinutes(1))
            ->get();
        $ordersToComplete = Order::where('orderStatus', OrderStatus::PENDING->value)
            ->where('created_at', '<=', now()->subMinutes(2))
            ->get();
        $ordersToPickupFail = Order::where('orderStatus', OrderStatus::COMPLETED->value)
            ->where('created_at', '<=', now()->subMinutes(4))
            ->get();

        if ($ordersToPending->count() > 0) {
            foreach ($ordersToPending as $order) {
                $order->orderStatus = OrderStatus::PENDING->value;
                $user = $order->user;
                event(new OrderPendingEvent($user));
                $order->update();
            }
        }
        if ($ordersToComplete->count() > 0) {
            foreach ($ordersToComplete as $order) {
                $order->orderStatus = OrderStatus::COMPLETED->value;
                $user = $order->user;
                event(new OrderCompletedEvent($user));
                $order->update();
            }
        }
        if ($ordersToPickupFail->count() > 0) {
            foreach ($ordersToPickupFail as $order) {
                $order->orderStatus = OrderStatus::CANCELED->value;
                $user = $order->user;
                event(new OrderPickupFailEvent($user));
                $order->update();
            }
        }
    }
}
