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
use App\Models\Ingredient;
use App\Models\LineOrders;
use App\Enums\PaymentStatus;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use App\Events\OrderConfirmedEvent;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class CheckoutComponent extends Component
{
    public $paymentMode = "card"; // Méthode de paiement en ligne par défaut
    public $nameOnCard;
    public $number;
    public $expirationDate;
    public $cvc;
    public $user;
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

        $restaurant = Restaurant::all()[0];


        if (!Session()->has('cart') || Cart::instance('cart')->count() === 0) {
            return redirect()->route('plat')->with('info', 'Vous n\'avez aucun produit dans le panier!');
        }

        // Si le restaurant est fermé et que la personne veut accéder à la page checkout, son panier est
        if ($restaurant->opened == 0) {
            Cart::instance('cart')->destroy();
            redirect()->route('home')->with('info', 'Le restaurant est fermé, vous ne pouvez pas faire de commande');
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
                'cvc.digits' => 'Le CVV doit comporter 3 chiffres',
            ]);


            $order = $this->makeCardOrder();
            $order->save();
            $this->fillPlatOrder($order->id);

            $names = "";

            if (session()->has('lowQuantity')) {
                foreach (session()->get('lowQuantity') as $name) {
                    $names .= '<br>' . $name . '<br>';
                }
            }



            if (!$this->decreaseQuantityInStock($order)) {
                return redirect()->route('cart')->with('warning', 'nous ne pouvons pas honorer votre commande. Veuillez diminuer la quantité de ce(s) produit(s): ' . $names);
            } else {
                try {
                    session()->forget('lowQuantity');  // On detruit la session 'lowQuantity'

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

            $names = "";

            if (session()->has('lowQuantity')) {
                foreach (session()->get('lowQuantity') as $name) {
                    $names .= '<br>' . $name . '<br>';
                }
            }

            if (!$this->decreaseQuantityInStock($order)) {
                return redirect()->route('cart')->with('warning', 'nous ne pouvons pas honorer votre commande. Veuillez diminuer la quantité de ce(s) produit(s): ' . $names);
            } else {

                session()->forget('lowQuantity');  // On detruit la session 'lowQuantity'

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

            if (session()->has('lowQuantity')) {
                foreach (session()->get('lowQuantity') as $name) {
                    $names .= '<br>' . $name . '<br>';
                }
            }


            if (!$this->decreaseQuantityInStock($order)) {
                return redirect()->route('cart')->with('warning', 'nous ne pouvons pas honorer votre commande. Veuillez diminuer la quantité de ce(s) produit(s): ' . $names);
            } else {

                session()->forget('lowQuantity');  // On detruit la session 'lowQuantity'

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


        // Si une session 'lowQuantity' existait déjà, on la detruit

        // if (session()->has('lowQuantity')) {
        //     session()->forget('lowQuantity');
        // }


        // Tableau qui va monitorer des quantités en stock de chaque produit, en fait d'éviter

        $ingredientQuantities = [];

        // Tableau où je stocke des produits en quantité insuffisance
        $lowQuantity = [];

        // dd($order->lineOrders);

        foreach ($order->lineOrders as $lineOrder) {

            /**
             *  On récupère pour chaque ligne de commande la propriété 'quantity' autrement dit on récupère la quantité de chaque plat ou boisson
             *  composant les lignes de commandes (table line_order) de la commande.
             */

            $quantity = $lineOrder->quantity;

            if ($lineOrder->plat && !empty($lineOrder->plat->ingredients)) {
                foreach ($lineOrder->plat->ingredients as $ingredient) {
                    // Si la quantité en stock de cet ingredient n'a pas encore été ajoutée dans notre tableau, on l'ajoute
                    if (!isset($ingredientQuantities[$ingredient->name])) {
                        $ingredientCopy = $this->shallowCopy($ingredient);
                        $ingredientQuantities[$ingredient->name] = $ingredientCopy;
                    }
                    // On met à jour la quantité en stock de cet ingredient décrémenté de la quantité nécessaire de cet ingrédient dans le plat concerné

                    $ingredientQuantities[$ingredient->name]->quantityInStock -= $ingredient->pivot->amount * $quantity;

                    // Si la quantité en stock de ce produit est inférieur à la quantité minimale

                    if ($ingredientQuantities[$ingredient->name]->quantityInStock <= $ingredientQuantities[$ingredient->name]->quantityMinimum) {
                        $order->delete();
                        $isOk_1 = false;
                        $lowQuantity[] = $lineOrder->plat->name;
                    }
                }
            }

            if ($lineOrder->drink) {
                // Check if we have encountered this drink before
                if (!isset($ingredientQuantities[$lineOrder->drink->name])) {
                    // Create a shallow copy of the drink to avoid affecting the database
                    $drinkCopy = $this->shallowCopy($lineOrder->drink);
                    $ingredientQuantities[$lineOrder->drink->name] = $drinkCopy;
                }

                // Calculate the updated quantity without affecting the database
                $ingredientQuantities[$lineOrder->drink->name]->quantityInStock -= $quantity;

                // Check if the updated quantity falls below the minimum
                if ($ingredientQuantities[$lineOrder->drink->name]->quantityInStock <= $ingredientQuantities[$lineOrder->drink->name]->quantityMinimum) {
                    $order->delete();
                    $isOk_2 = false;
                    $lowQuantity[] = $lineOrder->drink->name;
                }
            }
        }

        // Si aucun ingredient ou boisson n'est pas en danger de rupture de stock
        // on décremente du stock des ingredients, des quantités necessaires pour préparer chaque plat commandé su
        // on décremente du stock des boissons des quantités de chaque boisson commandée


        $ingredientQuantities = [];

        if ($isOk_1 && $isOk_2) {
            foreach ($order->lineOrders as $lineOrder) {
                $quantity = $lineOrder->quantity;
                if ($lineOrder->plat && !empty($lineOrder->plat->ingredients)) {
                    foreach ($lineOrder->plat->ingredients as $ingredient) {

                        if (!isset($ingredientQuantities[$ingredient->name])) {
                            $ingredientQuantities[$ingredient->name] = $ingredient;
                        }
                        // On met à jour la quantité en stock de cet ingredient décrémenté de la quantité nécessaire de cet ingrédient dans le plat concerné

                        $ingredientQuantities[$ingredient->name]->quantityInStock -= $ingredient->pivot->amount * $quantity;
                        $ingredientQuantities[$ingredient->name]->update();
                    }
                }

                if ($lineOrder->drink) {
                    if (!isset($ingredientQuantities[$lineOrder->drink->name])) {
                        $ingredientQuantities[$lineOrder->drink->name] = $lineOrder->drink;
                    }

                    $ingredientQuantities[$lineOrder->drink->name]->quantityInStock -= $quantity;
                    $ingredientQuantities[$lineOrder->drink->name]->update();
                }
            }
        }

        if (!empty($lowQuantity)) {
            session()->put('lowQuantity', $lowQuantity);
        }

        return ($isOk_1 && $isOk_2);
    }

    private function shallowCopy($object)
    {
        $newObject = new  Ingredient();

        $newObject->id = $object->id;
        $newObject->name = $object->name;
        $newObject->quantityInStock = $object->quantityInStock;
        $newObject->quantityMinimum = $object->quantityMinimum;

        return $newObject;
    }

    public function render()
    {
        //On injecte dans la vue le client authentifié le seul à même d'accéder à la page de paiement et procéder à la commande

        $client = $this->user;

        // On detruit les sessions qui nous permettent de sauvegarder les valeurs nos propriétés dans le formulaire de paiement par carte

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
        // On extrait une sous-chaîne de  4 premiers chiffres de la carte, puis on concatène avec 8 mask 'X', puis on concatène avec 4 derniers chiffres de la
        // carte
        return substr($number, 0, 4) . str_repeat($mask, strlen($number) - 8) . substr($number, 12, 15);
    }
}
