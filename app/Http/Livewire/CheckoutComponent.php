<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\Plat;
use App\Models\User;
use App\Models\Order;
use Livewire\Component;
use App\Enums\OrderStatus;
use App\Enums\PaymentMode;
use App\Models\LineOrders;
use App\Enums\PaymentStatus;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use App\Events\OrderConfirmedEvent;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CheckoutComponent extends Component
{
    public $paymentMode = "card"; // Méthode de paiement en ligne par défaut
    public $nameOnCard, $number, $expirationDate, $cvc, $user;
    public $acceptance; // Propriété pour vérifier si la checkbox des termes et conditions a été "checkée"

    //  Règles de validation

    protected $cardValidationRules = [
        'nameOnCard' => 'required',
        'number' => 'required|numeric|digits:16',
        'expirationDate' => 'required|date|after_or_equal:today',
        'cvc' => 'required|numeric|digits:3',
    ];

    // Nous mettons les propriétés dans des variables de session pour pouvoir les sauvegarder de page en page

    public function updated()
    {
        session()->put('nOc', $this->nameOnCard);
        session()->put('nbr', $this->number);
        session()->put('expD', $this->expirationDate);
        session()->put('cvc', $this->cvc);
        session()->put('acc', $this->acceptance);
    }

    public function mount()
    {
        $this->user = Auth::user(); // On récupère l'utilisateur authentifié.
        $this->acceptance = false;


        if (!Session()->has('cart') || Cart::instance('cart')->count() === 0) {
            return redirect()->route('plat')->with('info', 'Vous n\'avez aucun produit dans le panier!');
        }
        if ($this->user === null) {
            return redirect()->route('login')->with('info', 'Vous devez être connecté pour effectuer le paiement');
        }
    }

    public function placeOrder()
    {
        if ($this->paymentMode == "card") {

            $this->validate($this->cardValidationRules, [
                'nameOnCard.required' => 'Veuillez indiquer le nom et le prénom qui se trouvent sur la carte',
                'number.required' => 'Le numéro de carte est requis',
                'number.numeric' => 'Le numéro de carte doit être exclusivement en chiffres',
                'number.digits' => 'La carte doit comporter 16 chiffres',
                'expirationDate.required' => 'Vous devez indiquer la date d\'expiration de la carte',
                'expirationDate.date' => 'Vous devez saisir une date',
                'expirationDate.after_or_equal' => 'La date d\'expiration doit être supérieure ou égale à celle d\'aujourd\'hui',
                'cvc.required' => 'Le CCV est requis',
                'cvc.numeric' => 'Le CCV doit être en chiffres',
                'cvc' => 'Le CVV doit comporter 3 chiffres',
            ]);


            $order = $this->makeCardOrder();
            $order->save();
            $this->fillPlatOrder($order->id);

            if (!$this->decreaseQuantityInStock($order)) {
                return redirect()->route('cart')->with('warning', 'nous ne pouvons pas passer votre commande.');
            } else {
                try {

                    $stripe = Stripe::make(config('services.stripe.secret'));

                    $customer = $stripe->customers()->create([
                        'name' => $this->user->firstname . ' ' . $this->user->lastname,
                        'email' => $this->user->email,
                        'phone' => $this->user->phone,
                        'source' => 'tok_visa',
                    ]);

                    $charge = $stripe->charges()->create([
                        'customer' => $customer['id'],
                        'currency' => 'eur',
                        'amount' => Cart::instance('cart')->total(),
                        'description' => 'Paiement par carte de la commande n° ' . $order->id,
                    ]);

                    if ($charge['status'] == 'succeeded') {

                        // Destruction du panier

                        Cart::instance('cart')->destroy();

                        // On envoit un e-mail au client pour confirmer sa commande

                        event(new OrderConfirmedEvent($this->user));

                        return redirect()->route('checkout.success')->with('success', 'Nous confirmons votre commande. Nous vous informerons dès qu\'elle est prête');
                    } else {
                        session()->flash('payment_error', 'Il y a eu une erreur lors de la transaction!');
                        return redirect()->back();
                    }
                } catch (Exception $e) {
                    session()->flash('payment_error', $e->getMessage());
                    return redirect()->back();
                }
            }
        }

        if ($this->paymentMode == "cash") {

            $order = $this->makeCashOrder();
            $order->save();
            $this->fillPlatOrder($order->id);


            if (!$this->decreaseQuantityInStock($order)) {
                return redirect()->route('cart')->with('warning', 'nous ne pouvons pas honoré votre commande');
            } else {

                // Destruction du panier

                Cart::instance('cart')->destroy();

                // Envoyez l'e-mail au client pour confirmer sa commande en instanciant un événement OrderConfirmedEvent

                event(new OrderConfirmedEvent($this->user));

                // Après commande, on dirige le client vers la vue checkout.success

                return redirect()->route('checkout.success')->with('success', 'Nous confirmons votre commande. Nous vous informerons dès qu\'elle est prête');
            }
        }

        if ($this->paymentMode == "paypal") {

            $order = $this->makePayPalOrder();
            $order->save();
            $this->fillPlatOrder($order->id);


            $names = "";

            foreach (session()->get('lowQuantity') as $name) {
                $names .= '<br><br>'.$name.'<br>';
            }


            if (!$this->decreaseQuantityInStock($order)) {
                return redirect()->route('cart')->with('warning', 'nous ne pouvons pas honorer votre commande. Veuillez diminuer la quantité de ce(s) produit(s): ' . $names);
            } else {


                $provider = new PayPalClient;
                $provider->setApiCredentials(config('paypal'));
                $provider->setCurrency('EUR');
                $paypalToken = $provider->getAccessToken();


                $response = $provider->createOrder([
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => route('paypal.success', $this->user->id),
                        "cancel_url" => route('paypal.cancel'),
                    ],
                    "purchase_units" => [
                        [
                            "amount" => [
                                "currency_code" => "EUR",
                                "value" => Cart::instance('cart')->total()
                            ]
                        ]
                    ]
                ]);


                if (isset($response['id']) && $response['id'] != null) {
                    foreach ($response['links'] as $link) {
                        if ($link['rel'] === 'approve') {
                            return redirect()->away($link['href']);
                        }
                    }
                } else {
                    return redirect()->route('paypal.cancel');
                }
            }
        }
    }

    public function success(Request $request, User $user)
    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('EUR');
        $paypalToken = $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            // Destruction du panier

            Cart::instance('cart')->destroy();

            // Envoyez l'e-mail au client pour confirmer sa commande en instanciant un événement OrderConfirmedEvent

            event(new OrderConfirmedEvent($user));

            return redirect()->route('checkout.success')->with('success', 'Nous confirmons votre commande. Nous vous informerons dès qu\'elle est prête');
        } else {
            return redirect()->route('paypal.cancel');
        }
    }

    public function cancel()
    {
        return redirect()->back()->with('payment_error', 'Le paiement a été annulé');
    }


    private function fillPlatOrder($orderId)
    {
        foreach (Cart::instance('cart')->content() as $content) {
            $lineOrder = new LineOrders();

            $plat = Plat::where('name', $content->model->name)->first();

            if ($plat) {
                $lineOrder->plat_id = $content->model->id;
            } else {

                $lineOrder->drink_id = $content->model->id;
            }
            $lineOrder->order_id = $orderId;
            $lineOrder->quantity = $content->qty;
            $lineOrder->sellPrice = $content->model->price * $content->qty;

            $lineOrder->save();
        }
    }



    private function makeCardOrder(): Order
    {
        $order = new Order();

        $order->user_id = $this->user->id;
        $order->subtotal = Cart::instance('cart')->subtotal();
        $order->tva = Cart::instance('cart')->tax();
        $order->total = Cart::instance('cart')->total();
        $order->nameOnCard = $this->nameOnCard;
        $order->numberOnCard = CheckoutComponent::cardMasking($this->number, 'X');
        $order->expirationDate =  Carbon::parse($this->expirationDate)->format('Y-m-d');
        $order->paymentMode = PaymentMode::CARD->value;
        $order->paymentStatus = PaymentStatus::PAID->value;
        $order->orderStatus = OrderStatus::CONFIRMED->value;

        return $order;
    }

    private function makeCashOrder(): Order
    {
        $order = new Order();

        $order->user_id = $this->user->id;
        $order->subtotal = Cart::instance('cart')->subtotal();
        $order->tva = Cart::instance('cart')->tax();
        $order->total = Cart::instance('cart')->total();
        $order->paymentMode = PaymentMode::CASH->value;
        $order->paymentStatus = PaymentStatus::PAID->value;
        $order->orderStatus = OrderStatus::CONFIRMED->value;

        return $order;
    }

    private function makePayPalOrder(): Order
    {
        $order = new Order();

        $order->user_id = $this->user->id;
        $order->subtotal = Cart::instance('cart')->subtotal();
        $order->tva = Cart::instance('cart')->tax();
        $order->total = Cart::instance('cart')->total();
        $order->paymentMode = PaymentMode::PAYPAL->value;
        $order->paymentStatus = PaymentStatus::PAID->value;
        $order->orderStatus = OrderStatus::CONFIRMED->value;

        return $order;
    }

    private function decreaseQuantityInStock(Order $order): bool
    {
        $isOk_1 = true;
        $isOk_2 = true;
        $lowQuantity = [];

        foreach ($order->lineOrders as $lineOrder) {

            /**
             *  On récupère pour chaque ligne de commande la propriété 'quantity' autrement dit on récupère la quantité de chaque plat ou boisson
             *  composant les lignes de commandes (table line_order) de la commande.
             */

            $quantity = $lineOrder->quantity;


            if (!empty($lineOrder->plat->ingredients)) {
                foreach ($lineOrder->plat->ingredients as $lomi) {
                    $lomi->quantityInStock = $lomi->quantityInStock - $lomi->pivot->amount * $quantity;

                    if ($lomi->quantityInStock <= 0) {
                        $isOk_1 = false;
                        $lowQuantity[] = $lineOrder->plat->name;
                        // break;
                        $lomi->quantityInStock += $lomi->pivot->amount * $quantity;
                    }
                }
            }



            if (!empty($lineOrder->drink)) {
                $lineOrder->drink->quantityInStock = $lineOrder->drink->quantityInStock - $quantity;

                if ($lineOrder->drink->quantityInStock <= 0) {
                    $isOk_2 = false;
                    $lowQuantity[] = $lineOrder->drink->name;
                }
            }

            if ($isOk_1 && $isOk_2) {
                foreach ($lineOrder->plat->ingredients as $lomi) {
                    $lomi->update();
                }

                if (!empty($lineOrder->drink)) {

                    $lineOrder->drink->update();
                }
            } else {
                $order->delete();
            }
        }

        session(['lowQuantity' => $lowQuantity]);

        return ($isOk_1 && $isOk_2);
    }

    public function render()
    {
        //On injecte dans la vue le client authentifié le seul à même d'accéder à la page de paiement et procéder à la commande
        $client = $this->user;

        $this->acceptance = session()->get('acc');
        $this->number = session()->get('nbr');
        $this->nameOnCard = session()->get('nOc');
        $this->expirationDate = session()->get('expD');
        $this->cvc = session()->get('cvc');

        return view('frontend.livewire.checkout-component', compact('client'));
    }

    // Méthode statique utilitaire pour masquer le numéro de carté de crédit qui sera conservé dans notre BDD

    private static function cardMasking($number, $mask = 'X')
    {
        return substr($number, 0, 4) . str_repeat($mask, strlen($number) - 8) . substr($number, -4);
    }
}
