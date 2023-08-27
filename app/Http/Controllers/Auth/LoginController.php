<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Events\LoginSubmitDeniedEvent;
use App\Http\Requests\LoginSubmitRequest;

class LoginController extends Controller
{
    public function login()
    {
        // Renvoit la page (la vue) de connexion
        return view('auth.login');
    }

    public function login_submit(LoginSubmitRequest $request)
    {

        // On fait appel à la méthode validated() pour appliquer les règles de validation que nous avons définies dans la classe LoginSubmitRequest

        $request->validated();

        // On récupère un objet eloquent $user à qui appartient l'adresse e-mail entrée

        $user = User::where('email', $request->email)->first();  // renvoit l'objet en questionb ou null

        // On vérifie que mot de passe saisi correspond à celui fourni lors de l'enregistrement

        $pwd_check = Hash::check($request->password, $user->password); // Renvoit true ou false

        // On créer une variable booléenne qui vérifie si les identifiants saisis sont tous les deux bons?

        $credentialsIsOk = $user && $pwd_check ? true : false;

        /**
         *  On récupère le status du compte. Soit il est activé (active) ou en attente d'activation (pending). Si le status est pending,
         *  l'utilisateur ne peut pas se connecter. Il doit impérativement activer son compte grâce au lien qui lui a été envoyé lors de son inscription.
         */

        $accountStatus = $user->status;


        if ($credentialsIsOk && $accountStatus ==  UserStatus::ACTIVE) {

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
             * mot de passe lui a été envoyé, le champ token est donc rempli.
             * Si entretemps il retrouve son ancien mot de passe avant d'avoir fait un changement, il faut bien mettre à vide le champ token
             * lors de sa connection. Pour rappel, dans notre système d'inscription et d'authentification, le token n'est généré que lorsque l'application
             * doit envoyer des liens de vérification cliquables par mail aux utilisateurs.
             */

            if ($user->token)  // Si le user a un token
            {
                $user->token = '';  // On l'efface dans le champ token de la table
                $user->update(); // On met à jour les informations de l'utilisateur.
            }

            if (Auth::attempt($credentials)) {

                return redirect()->route('home')->with('success', 'Bonjour ' . $user->firstname . ', Vous êtes connecté!');
            } else {
                return redirect()->back()->with('error', 'Une erreur s\'est produite. Veuillez retenter une connexion.');

            }

        }
        elseif (!$credentialsIsOk)
        {
            /**
             * Si la vériable $credentialsOk est 'false', seule la variable $pwd_check est en cause puisque l'adresse e-mail de l'utilisateur
             * est vérifiée comme existante dans la BDD grâce aux règles de validation que nous avons définies dans la classe LoginSubmitRequest
             * L'utilisateur reste sur la page login et reçoit un message flash l'invitant à taper le bon mot de passe.
             */

            return redirect()->back()->with('error', 'Mot de passe incorrect');
        }
        else
        {

            /**
             * Si les crédentials sont bons mais que la connexion est réfusée, cela est dûe au fait que l'utilisateur n'a pas valide son compte
             * en cliquant sur le lien qui lui a été envoyé lors de son inscription. Nous devons donc renvoyer par mail un nouveau lien à l'utilisateur.
             * On va utiliser le système de gestion d'événement de Laravel (Events & Listeners) pour gérer cette tâche
             */

            // On déclenche l'événement à l'intérieur duquel on instancie un objet de la classe LoginSubmitDeniedEvent que nous avons crée

            //$user->token = hash('sha256', time());  // On crée un nouveau token puisqu'on va envoyer un lien de vérification
            //$user->update();  // Enregistrement effectif de ce token dans la BDD

            // event(new LoginSubmitDeniedEvent($user));

            // L'utilisateur reste sur la page login et reçoit un message flash l'informant de la nécessité d'activer son compte pour se connecter.

            return redirect()
            ->back()
            ->with('error', 'Votre compte n\'est pas activé. Activez-le en cliquant sur le lien envoyé à votre boîte e-mail ou prenez contact avec nous.');
        }

    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout(); // On se déconnecte
        $request->session()->invalidate(); // On supprime toutes les données de la session
        $request->session()->regenerateToken();  // Pour permettre à laravel de régéner le jeton de session.

        // On rediriger l'utilisateur déconnecté vers la page d'accueil

        return $request->wantsJson()
        ? new JsonResponse([], 204)
        : redirect()->route('home');

    }

}
