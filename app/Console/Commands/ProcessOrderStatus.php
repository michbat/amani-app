<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Enums\OrderStatus;
use Illuminate\Console\Command;
use App\Events\OrderPendingEvent;
use App\Events\OrderCompletedEvent;
use App\Events\OrderNotCollectedEvent;
use App\Events\OrderPickedUpEvent;


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

        $onlyDrinkInOrder = true;  // Une variable booléenne "drapeau" qui va trahir la présence ou pas d'un plat dans les lignes de commande

        // Je selectionne des commandes confirmées

        $orders = Order::where('orderStatus', OrderStatus::CONFIRMED->value)
            ->where('created_at', '<=', now()->subSeconds(3))
            ->get();

        //Je vérifie d'abord si dans ces commandes, il n'y a que des boissons

        foreach ($orders as $order) {

            foreach ($order->lineOrders as $lineOrder) {
                // Si dans les lignes de commande, il y a au moins une ligne qui contient un memu (dont plat_id non vide)
                if ($lineOrder->plat_id != '') {
                    $onlyDrinkInOrder = false;  // Notre variable drapeau se met à false. Cette commande contient donc au moins un plat
                }
            }

            // Si on n'a aucun plat dans les lignes de commande alors ce qu'on a commandé uniquement des boissonns.
            // Dans ce cas, on met le OrderStatus à récupérée (pickedup) puisque les commandes contenant uniquement des boissons
            // ne peuvent se dérouler qu'à l'intérieur du resto en plus d'être faites par le personnel "Generic" pour le compte du client et surtout, il n'y a pas d'étapes de préparation. La boissson est servie directement.

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


        // Je récupère des commandes confirmées depuis 5 minutes

        $ordersToPending = Order::where('orderStatus', OrderStatus::CONFIRMED->value)
            ->where('created_at', '<=', now()->subMinutes(1))
            ->get();

        // Je récupère des commandes en préparation depuis 30 minutes
        $ordersToComplete = Order::where('orderStatus', OrderStatus::PENDING->value)
            ->where('created_at', '<=', now()->subMinutes(3))
            ->get();

        // Je récupère des commandes prêtes qui n'ont pas été récupérée depuis 1h30

        $ordersNotCollected = Order::where('orderStatus', OrderStatus::COMPLETED->value)
            ->where('created_at', '<=', now()->subMinutes(6))
            ->get();



        // S'il existe des commandes confirmées depuis 5 minutes, je les mets en préparation

        if ($ordersToPending->count() > 0) {
            foreach ($ordersToPending as $order) {
                $order->orderStatus = OrderStatus::PENDING->value;
                $user = $order->user;
                event(new OrderPendingEvent($user));
                $order->update();
            }
        }

        // S'il existe des commandes ayant le status pending depuis 30 minutes, elles sont mise à prêtes conformement à notre politique commerciale

        if ($ordersToComplete->count() > 0) {
            foreach ($ordersToComplete as $order) {
                $order->orderStatus = OrderStatus::COMPLETED->value;
                $user = $order->user;
                event(new OrderCompletedEvent($user));
                $order->update();
            }
        }

        // Si des commandes prêtes ne sont pas récupérées depuis 1h30, la commande est annulée et au détriment du client

        if ($ordersNotCollected->count() > 0) {
            foreach ($ordersNotCollected as $order) {
                $order->orderStatus = OrderStatus::NOTCOLLECTED->value;
                $user = $order->user;
                event(new OrderNotCollectedEvent($user));
                $order->update();
            }
        }
    }
}
