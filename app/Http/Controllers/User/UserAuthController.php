<?php

namespace App\Http\Controllers\User;

use App\Enums\OrderStatus;
use App\Enums\UserStatus;
use App\Events\EditPasswordSubmitEvent;
use App\Events\EditProfileSubmitEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditPasswordSubmitRequest;
use App\Http\Requests\EditProfileSubmitRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function edit_password()
    {
        return view('user.edit_password'); // Renvoie la vue ou le formulaire
    }

    public function edit_password_submit(EditPasswordSubmitRequest $request)
    {
        // On vérifie si nos règles de validation définies dans EditPasswordSubmitRequest sont respectées lors de la saisie du nouveau MDP

        $request->validated();

        // On récupère l'utilisateur connecté

        $user = User::where('id', Auth::user()->id)->first();

        $user->password = $request->password_new; // On lui affecte le nouveau mot de passe
        $user->update(); // On met à jour les données dans la BDD

        // On envoit un e-mail de confirmation de changement de mot de passe à l'utilisateur en utilisant l'événement EditPasswordSubmitEvent()
        event(new EditPasswordSubmitEvent($user));

        // On redirige l'utilisateur vers son dashboard

        return redirect()->route('user.dashboard')->with('success', 'Votre mot de passe a été modifié');
    }

    public function edit_profile()
    {
        // On récupère l'utilisateur connecté que l'on va injecter par la suite dans la vue pour afficher ses informations courantes

        $user = User::where('id', Auth::user()->id)->first();
        return view('user.edit_profile', compact('user'));
    }

    public function edit_profile_submit(EditProfileSubmitRequest $request)
    {

        $request->validated();

        // On récupère l'utilisateur qui cherche à modifier son profil

        $user = User::where('id', Auth::user()->id)->first();

        // On met à jour ses données

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;

        // Si l'utilisateur garde la même adresse e-mail, on le redirige vers son tableau de bord avec un message flash l'informant du succès.

        if ($user->email == $request->email) {
            $user->update(); // On rend effectif les changements dans la BDD
            return redirect()->route('user.dashboard')->with('success', 'Votre profile a été mise à jour');
        } else {
            /**
             * Si l'utilisateur change son adresse e-mail, il faut donc relancer le processus de vérification de cette nouvelle adresse
             * Cela est d'autant plus important que l'adresse e-mail est utilisée pour se connecter.
             */
            // On génère un nouveau token

            $token = hash('sha256', time());

            $user->token = $token; // On affecte le token au champ token de la table 'users' de la  BDD
            $user->status = UserStatus::PENDING->value; // On met le status du compte à "pending"
            $user->email = $request->email; // On affecte la nouvelle adresse e-mail au champ e-mail

            $user->update(); // On rend effectif ces changement

            // On declenche un événement afin d'envoyer à l'utiliser un lien cliquable de vérification à sa nouvelle adresse e-mail

            event(new EditProfileSubmitEvent($user));

            Auth::guard('web')->logout(); // On déconnecte l'utilisateur
            $request->session()->invalidate(); // On detruit la session de connexion

            // On rediriger l'utilisateur déconnecté vers la page d'accueil en l'invitant à cliquer sur le lien qui lui a été envoyé à sa nouvelle adresse e-mail

            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect()->route('home')->with('info', 'Vous avez changé votre adresse e-mail. Veuillez cliquez sur le lien envoyé à votre nouvelle adresse pour réactiver votre compte et vous connecter.');
        }
    }

    // Commandes

    public function user_orders_index()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('user.orders_index', compact('orders'));
    }

    public function user_order_cancel(Order $order)
    {
        if ($order->orderStatus->value == OrderStatus::CONFIRMED->value) {
            $order->orderStatus = OrderStatus::CANCELED->value;
            $order->update();
            return redirect()->back()->with('success', 'Votre commande a été annulée');
        } else {
            return redirect()->back()->with('warning', 'Trop tard. Seules des commandes avec le status "confirmé" peuvent être annulées');
        }
    }
}
