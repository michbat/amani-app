<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Enums\OrderStatus;
use App\Events\OrderCompletedEvent;
use Illuminate\Console\Command;
use App\Events\OrderPendingEvent;

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
        $ordersToPending = Order::where('orderStatus', OrderStatus::CONFIRMED->value)
            ->where('created_at', '<=', now()->subMinutes(5))
            ->get();
        $ordersToComplete = Order::where('orderStatus', OrderStatus::PENDING->value)
            ->where('created_at', '<=', now()->subMinutes(30))
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
    }
}
