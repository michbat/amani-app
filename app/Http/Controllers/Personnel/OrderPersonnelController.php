<?php

namespace App\Http\Controllers\Personnel;

use App\Models\User;
use App\Models\Order;
use App\Enums\OrderStatus;
use App\Enums\PaymentMode;
use App\Enums\PaymentStatus;
use Illuminate\Http\Request;
use App\Events\OrderCanceledEvent;
use App\Events\OrderPickedUpEvent;
use App\Http\Controllers\Controller;
use App\Events\OrderInterruptedEvent;
use App\Events\OrderFailedRefundedEvent;

class OrderPersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'DESC')->paginate(10);  // Tous les commandes en commençant par les plus recentes

        return view('personnel.orders.index', compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $users = User::orderBy('firstname')->get();
        $paymentmodes = PaymentMode::cases();
        $orderstatus = OrderStatus::cases();
        $paymentstatus = PaymentStatus::cases();

        return view('personnel.orders.edit', compact('order', 'users', 'paymentmodes', 'orderstatus', 'paymentstatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        // On vérifier si les données mises à jour respectent nos règles de valication

        $request->validate([
            'subtotal' => 'required|numeric',
            'tva' => 'required|numeric',
            'total' => 'required|numeric',
            'paymentMode' => 'required',
            'paymentStatus' => 'required',
            'orderStatus' => 'required',
            'nameOnCard' => 'required_if:paymentMode,card',

        ]);


        $order->subtotal = $request->subtotal;
        $order->tva = $request->tva;
        $order->total = $request->total;
        $order->paymentMode = $request->paymentMode;
        $order->paymentStatus = $request->paymentStatus;
        $order->orderStatus = $request->orderStatus;

        if ($request->paymentMode === PaymentMode::CARD) {
            $order->nameOnCard = $request->nameOnCard;
        }

        $order->save();

        switch ($order->orderStatus->value) {
            case OrderStatus::CANCELED->value:
                $order->total = 0;
                $order->subtotal = 0;
                $order->tva = 0;
                $order->update();
                event(new OrderCanceledEvent($order->user));
                break;
            case OrderStatus::PICKEDUP->value:
                event(new OrderPickedUpEvent($order->user));
                break;
            case OrderStatus::INTERRUPTED->value:
                $order->total = 0;
                $order->subtotal = 0;
                $order->tva = 0;
                $order->update();
                event(new OrderInterruptedEvent($order->user));
                break;
            default:
                # code...
                break;
        }


        return redirect()->route('personnel.orders.index')->with('toast_success', 'La commande a été mise à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('personnel.orders.index')->with('toast_success', 'La commande a été supprimée');
    }
}
