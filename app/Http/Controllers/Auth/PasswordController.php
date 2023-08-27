<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserStatus;
use App\Events\ForgotPasswordSubmitEvent;
use App\Events\ResentLinkSubmitEvent;
use App\Events\ResetPasswordConfirmationEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordSubmitRequest;
use App\Http\Requests\ResentLinkSubmitRequest;
use App\Http\Requests\ResetPasswordSubmitRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    /**
     * Méthode qui renvoit la vue pour permettre à l'utilisateur de saisir son adresse e-mail en vue du renouvellement de son mot de passe
     */

    public function forgot_password()
    {
        return view('auth.password.forgot_password');
    }

    /**
     * Methode pour gérer le formulaire d'envoi de l'e-mail
     */

    public function forgot_password_submit(ForgotPasswordSubmitRequest $request)
    {
        /**
         * On vérifie si nos règles de validation définies dans la classe ForgotPasswordSubmitRequest ont été respectées
         */

        $request->validated();

        // On récupère l'objet $user propriétaire de l'adresse e-mail saisie dans le formulaire

        $user = User::where('email', $request->email)->first();

        // Si le compte n'est pas encore activé, on informe l'utilisateur qu'il ne peut pas changer le mot de passe d'un compte non-encore activé.

        if ($user->status->value === UserStatus::PENDING->value) {
            return redirect()->back()->with('info', 'Votre compte n\'est pas activé. Vous ne pouvez pas changer de mot de passe. Veuillez consulter l\'e-mail avec lien d\'activation qui vous a été envoyé ou prenez contact avec nous.');
        }


        // On génère un nouveau dans le cadre du reset du mot de passe. Token qui servira au processus de vérification

        $token = hash('sha256', time()); // La fonction native PHP hash() hâche l'heure courante mesurée en secondes depuis le 1er janvier 1970 00:00:00 GMT

        $user->token = $token; // On réaffecter le nouveau token généré au champ token de la table 'users'
        $user->update(); // On met à jour les données de l'utilisateur en tenant compte de l'affectation du token au champ token

        /**
         * On declenche un événement en vue d'envoyer un e-mail contenant le lien sur lequel le requerant doit cliquez
         * pour entamer le processus de renouvellement de son mot de passe.
         * On redirige l'utilisateur vers la page d'accueil avec un message flash info lui confirmant l'envoi du lien pour renouveler
         * son mot de passe
         */
        event(new ForgotPasswordSubmitEvent($user));
        return redirect()->route('home')->with('info', 'Un lien pour changer votre mot de passe a été envoyé à votre adresse e-mail.');

    }

    /**
     * Méthode pour vérifier "l'intégrite" du lien envoyée en vue du renouvellement du mot de passe
     */

    public function reset_password($token, $email)
    {
        // On cherche l'objet $user qui possède le token et l'adresse e-mail contenu dans le lien cliqué

        $user = User::where('token', $token)->where('email', $email)->first();

        // Si on ne trouve pas d'utilisateur parce que le token ou l'adresse e-mail ne sont pas bons.

        if (!$user) {
            // On le redirige vers la page d'accueil avec le message flash lui informant du problème avec le lien.

            return redirect()->route('resent.link')->with('error', 'Le lien a expiré ou n\'est plus valable.');
        }

        // Si l'utilisateur est trouvé, on le redirige vers la vue afin de procéder à la mise à jour de son mot de passe

        return view('auth.password.reset_password', compact('token', 'email'));
    }

    public function reset_password_submit(ResetPasswordSubmitRequest $request)
    {
        // On vérifie si les données saisies respectent nos règles de validation définies dans la classe ResetPasswordSubmitRequest

        $request->validated();

        // On recherche l'utilisateur qui correspond à ce couple token-email dans la BDD.

        $user = User::where('token', $request->token)->where('email', $request->email)->first();
        $user->token = ''; // On remet le champ token à vide
        $user->password = Hash::make($request->password); //On hashe le nouveau mot de passe de l'utilisateur

        $user->update(); // On met à jour les données de l'utilisateur

        /**
         * On déclenche un événement afin d'envoyer un e-mail de confirmation du changement de mot de passe
         * On redirige l'utilisateur vers la page login avec le message de session flash l'informant du changement de son mot de passe
         */

        event(new ResetPasswordConfirmationEvent($user));

        return redirect()->route('login')->with('success', 'Votre mot de passe a été mis à jour. Vous pouvez maintenant l\'utiliser pour vous connecter.');
    }

    public function resent_link()
    {
        return view('auth.password.resent_link');
    }
    public function resent_link_submit(ResentLinkSubmitRequest $request)
    {

        // On vérifie si l'adresse e-mail saisie respecte nos règles de validation définies dans la classe ResentLinkSubmitRequest

        $request->validated();

        /**
         * Si un lien de renouvellement du mot de passé a déjà été envoyé à l'utilisateur, on lui envoit à nouveau
         * un lien cliquable avec le couple token/e-mail
         */

        $user = User::where('email', $request->email)->first(); // On cherche l'utilisateur avec l'e-mail entré dans le formulaire
        $user->token = hash('sha256', time()); // On regèner un token que l'on affecte au champ token de la table users
        $user->update(); // On rend le changement effectif

        /**
         * On déclenche un événement ResentLinkSubmitEvent afin d'informer l'utilisation du nouveau envoi du lien cliquable en vue
         * de changer son mot de passe
         * On redirige l'utilisateur vers la page d'accueil avec un message de session flash l'informant de l'envoie du lien
         */

        event(new ResentLinkSubmitEvent($user));

        return redirect()->route('home')->with('info', 'Un lien pour changer votre mot de passe a été à nouveau envoyé à votre adresse e-mail.');

    }

}
