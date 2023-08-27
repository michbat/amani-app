<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\Order;
use Livewire\Component;
use App\Models\MenuOrder;
use App\Enums\OrderStatus;
use App\Enums\PaymentMode;
use App\Enums\PaymentStatus;
use Cartalyst\Stripe\Stripe;
use App\Events\OrderConfirmedEvent;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutComponent extends Component
{
    public $paymentMethod = "card"; // Méthode de paiement en ligne par défaut
    public $nameOnCard, $number, $exp_month, $exp_year, $cvc, $user;

    public function mount()
    {
        $this->user = Auth::user(); // On récupère l'utilisateur authentifié.

        if (!Session()->has('cart') || Cart::count() === 0) {
            return redirect()->route('menu')->with('info', 'Vous n\'avez aucun produit dans le panier!');
        }
        if ($this->user === null) {
            return redirect()->route('login')->with('info', 'Vous devez être connecté pour effectuer le paiement');
        }
    }

    public function placeOrder()
    {
        if ($this->paymentMethod == "card") {

            $this->validate(
                [
                    'nameOnCard' => 'required',
                    'number' => 'required|numeric|digits:16',
                    'exp_month' => 'required|numeric|digits_between:1,2',
                    'exp_year' => 'required|numeric|digits:4',
                    'cvc' => 'required|numeric|digits:3',
                ],
                [
                    'nameOnCard.required' => 'Veuillez indiquer le nom et le prénom qui se trouvent sur la carte',
                    'number.required' => 'Le numéro de carte est requis',
                    'number.numeric' => 'Le numéro de carte doit être exclusivement en chiffres',
                    'number.digits' => 'La carte doit comporter 16 chiffres',
                    'exp_month.required' => 'Le mois d\'expiration',
                    'exp_month.numeric' => 'Le mois doit être en chiffres',
                    'exp_month.digits_between' => 'Saisissez un ou deux chiffre pour indiquer le mot d\'expiration. Ex: 9,10',
                    'exp_year.required' => 'L\'année d\'expiration',
                    'exp_year.numeric' => 'L\'année doit être en chiffres',
                    'exp_year.digits' => 'L\'année d\'expiration doit comporter 4 chiffres',
                    'cvc.required' => 'Le CCV est requis',
                    'cvc.numeric' => 'Le CCV doit être en chiffres',
                    'cvc' => 'Le CVV doit comporter 3 chiffres',
                ]
            );

            $order = $this->makeCardOrder();

            // Création d'un objet $stripe

            try {

                $stripe = Stripe::make(config('services.stripe.secret'));
                // $token = $stripe->tokens()->create([
                //     'card' => [
                //         'number' => $this->number,
                //         'exp_month' => $this->exp_month,
                //         'exp_year' => $this->exp_year,
                //         'cvc' => $this->cvc,
                //     ],
                // ]);

                // if (!isset($token['id'])) {
                //     session()->flash('stripe_error', 'Stripe n\'a pas correctement généré un token de sécurité');
                //     return redirect()->back();
                // }

                $customer = $stripe->customers()->create([
                    'name' => $this->user->firstname . ' ' . $this->user->lastname,
                    'email' => $this->user->email,
                    'phone' => $this->user->phone,
                    'source' => 'tok_visa',
                ]);

                $charge = $stripe->charges()->create([
                    'customer' => $customer['id'],
                    'currency' => 'eur',
                    'amount' => Cart::total(),
                    'description' => 'Paiement par carte de la commande n° ' . $order->id,
                ]);

                if ($charge['status'] == 'succeeded') {
                    $order->save();
                    $this->fillMenuOrder($order->id);
                    Cart::destroy();

                    event(new OrderConfirmedEvent($this->user));

                    return redirect()->route('checkout.success')->with('success', 'Nous confirmons votre commande. Nous vous informerons dès qu\'elle est prête');
                } else {
                    session()->flash('stripe_error', 'Il y a eu une erreur lors de la transaction!');
                    return redirect()->back();
                }
            } catch (Exception $e) {
                session()->flash('stripe_error', $e->getMessage());
                return redirect()->back();
            }
        } else if ($this->paymentMethod == "cash") {

            $order = $this->makeCashOrder();

            $order->save();

            $this->fillMenuOrder($order->id);

            // Destruction du panier

            Cart::destroy();

            // Envoyez l'e-mail au client pour confirmer sa commande en instanciant un événement OrderConfirmedEvent

            event(new OrderConfirmedEvent($this->user));

            // Après commande, on dirige le client vers la vue checkout.success

            return redirect()->route('checkout.success')->with('success', 'Nous confirmons votre commande. Nous vous informerons dès qu\'elle est prête');
        }
    }

    private function fillMenuOrder($orderId)
    {
        foreach (Cart::content() as $content) {
            $menuOrder = new MenuOrder();

            $menuOrder->menu_id = $content->model->id;
            $menuOrder->order_id = $orderId;
            $menuOrder->quantity = $content->qty;
            $menuOrder->sellPrice = $content->model->price * $content->qty;

            $menuOrder->save();
        }
    }

    private function makeCardOrder(): Order
    {
        $order = new Order();

        $order->user_id = $this->user->id;
        $order->subtotal = Cart::subtotal();
        $order->tva = Cart::tax();
        $order->total = Cart::total();
        $order->nameOnCard = $this->nameOnCard;
        $order->numberOnCard = CheckoutComponent::cardMasking($this->number, 'X');
        $order->expirationDate = $this->exp_month . '/' . $this->exp_year;
        $order->paymentMode = PaymentMode::CARD->value;
        $order->paymentStatus = PaymentStatus::PAID->value;
        $order->orderStatus = OrderStatus::CONFIRMED->value;

        return $order;
    }

    private function makeCashOrder(): Order
    {
        $order = new Order();

        $order->user_id = $this->user->id;
        $order->subtotal = Cart::subtotal();
        $order->tva = Cart::tax();
        $order->total = Cart::total();
        $order->paymentMode = PaymentMode::CASH->value;
        $order->paymentStatus = PaymentStatus::DUE->value;
        $order->orderStatus = OrderStatus::CONFIRMED->value;

        return $order;
    }

    public function render()
    {
        //On injecte dans la vue le client authentifié le seul à même d'accéder à la page de paiement et procéder à la commande
        $client = $this->user;

        return view('frontend.livewire.checkout-component', compact('client'));
    }

    // Méthode statique utilitaire pour masquer le numéro de carté de crédit qui sera conservé dans notre BDD

    private static function cardMasking($number, $mask = 'X')
    {
        return substr($number, 0, 4) . str_repeat($mask, strlen($number) - 8) . substr($number, -4);
    }
}
