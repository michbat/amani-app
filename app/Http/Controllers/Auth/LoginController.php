<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Enums\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LoginSubmitRequest;
use Gloudemans\Shoppingcart\Facades\Cart;

class LoginController extends Controller
{

    public function login()
    {

        //Si la personne est connectée, elle ne doit pas accéder à nouveau à la page login (imaginons une personne qui tape la route vers la page login la barre d'adresse de son navigateur)

        if (Auth::check()) {
            return redirect()->back()->with('warning', 'Vous êtes déjà connecté!');
        }

        // Je stocke dans une variable de session, la route (la page) précédente sur laquelle le visiteur était avant de tenter de se connecter
        // L'intérêt de cette démarche est de le ramèner à la page qu'il visitait une fois authentifié.



        if (url()->previous() != "http://localhost:8000/login") {
            Session::put('previous_url', url()->previous());
        }


        return view('auth.login');
    }

    public function loginSubmit(LoginSubmitRequest $request)
    {

        // On fait appel à la méthode validated() pour appliquer les règles de validation que nous avons définies dans la classe LoginSubmitRequest

        $request->validated();

        // On récupère un objet eloquent $user à qui appartient l'adresse e-mail entrée

        $user = User::where('email', $request->email)->first();  // renvoit l'objet eloquent $user si celui-ci existe dans la BDD ou null

        // On vérifie que mot de passe saisi correspond à celui fourni lors de l'enregistrement

        $pwd_check = Hash::check($request->password, $user->password); // Renvoit true ou false

        // On créer une variable booléenne qui vérifie si les identifiants saisis sont tous les deux bons?

        $credentialsIsOk = $user && $pwd_check ? true : false;

        /**
         *  On récupère le status du compte. Soit il est activé (active) ou en attente d'activation (pending). Si le status est pending,
         *  l'utilisateur ne peut pas se connecter. Il doit impérativement activer son compte grâce au lien qui lui a été envoyé lors de son inscription.
         */

        $accountStatus = $user->status->value;



        if ($credentialsIsOk && $accountStatus ==  UserStatus::ACTIVE->value) {

            /**
             * Lorsque les credentials sont bons et que le compte est activé, on redirige l'utilisateur vers son compte
             * avec un message flash de bienvenue. On crée une session de connexion grâce à la méthode attempt() qui reçoit
             * en argument un tableau $credentials contenant des variables 'email','password','status'
             *
             */

            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
                'status' => $accountStatus,
            ];


            /**
             * Dans le cas où l'utilisateur a lancé le processus de changement de mot de passe et qu'un lien cliquable pour changer le
             * mot de passe lui a été envoyé, le champ token n'est donc pas vide.
             * Si entretemps il retrouve la mémoire donc son ancien mot de passe avant d'avoir fait un changement, il faut bien mettre à vide le champ token
             * lors de sa connection. Pour rappel, dans notre système d'inscription et d'authentification, le token n'est généré que lorsque l'application
             * doit envoyer des liens de vérification cliquables par mail aux utilisateurs.
             */

            if ($user->token)  // Si jamais le user a encore un token
            {
                $user->token = '';  // On l'efface dans le champ token de la table
                $user->update(); // On met à jour les informations de l'utilisateur.
            }

            if (Auth::attempt($credentials)) {

                // Si l'utilisateur est authentifié et non 'Generic', on restaure son panier et sa wishlist sauvegardés

                if (Auth::check() && Auth::user()->firstname !== 'Generic') {

                    Cart::instance('cart')->restore(Auth::user()->id);
                    Cart::instance('wishlist')->restore(Auth::user()->id);
                }

                // S'il est 'Generic', on restaure uniquement son panier

                if (Auth::check() && Auth::user()->firstname === 'Generic') {
                    Cart::instance('cart')->restore(Auth::user()->id);
                }

                // Une fois connecté, on ramène l'utilisateur à la page qu'il visitait avant de s'authentifier

                return redirect(Session::get('previous_url'))->with('success', 'Bonjour ' . $user->firstname . ', Vous êtes connecté!');
            } else {
                return redirect()->back()->with('error', 'Une erreur s\'est produite. Veuillez retenter une connexion.');
            }
        } elseif (!$credentialsIsOk) {
            /**
             * Si la vériable $credentialsOk est 'false', seule la variable $pwd_check est en cause puisque l'adresse e-mail de l'utilisateur
             * est vérifiée comme existante dans la BDD grâce aux règles de validation que nous avons définies dans la classe LoginSubmitRequest
             * L'utilisateur reste sur la page login et reçoit un message flash l'invitant à taper le bon mot de passe.
             */

            return redirect()->back()->with('error', 'Mot de passe incorrect');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Votre compte n\'est pas activé. Activez-le en cliquant sur le lien envoyé à votre boîte e-mail ou prenez contact avec nous.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();  // Instruction pour déconnecter un utilisateur connecté.

        // On detruit les instances du panier et de la wishlist en cours

        Cart::instance('cart')->destroy();
        Cart::instance('wishlist')->destroy();

        // On detruit la session 'previous_url

        session()->forget('previous_url');

        // On redirige l'utilisateur déconnecté (donc qui devient un guestà vers la page d'accueil

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->route('home')->with('success', 'Vous vous êtes déconnecté avec succès');
    }
}
