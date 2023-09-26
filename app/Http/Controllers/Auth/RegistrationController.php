<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserStatus;
use App\Events\RegisterConfirmationEvent;
use App\Events\RegisterVerifyEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterSubmitRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    /**
     * Methode qui renvoit la page d'enregistrement
     */
    public function register()
    {
        // Renvoie la vue dans laquelle se trouve le formulaire d'inscription.

        return view('auth.registration.register');
    }

    /**
     * Méthode qui enregistre les données saisies dans le formulaire dans la BDD
     */
    public function registerSubmit(RegisterSubmitRequest $request)
    {

        /**
         * On vérifie d'abord si les données saisies respectent nos règles de validation définie dans la classe RegisterSubmitRequest.
         * Des messages d'erreur définies par nos soins s'affichent si les données saisies dans le formulaire ne respectent pas nos règles.
         */

        $request->validated();

        /**
         * On genère un nouveau token grâce à la fonction de hashage native de PHP pour le besoin de vérification et d'activation du compte via un lien cliquable
         * qui est envoyé par mail au nouveau utilisateur inscrit.
         */

        $token = hash('sha256', time()); // La fonction native PHP hash() hâche l'heure courante mesurée en secondes depuis le 1er janvier 1970 00:00:00 GMT retournée par time() en utilisant l'algorithme de hachage sha256

        // On crée un nouvel objet $user de la classe Model User.

        $user = new User();

        // On recupère la clé primaire de la table 'roles' dont le champ 'name' est 'user'. Cette clé primaire est la clé étrangère de la table 'users'

        $userRoleId = Role::where('name', 'user')->first()->id;

        /**
         * On enregistre les données saisies par le nouveau utilisateur dans la BDD
         * Le nouveau utilisateur enregistré a donc par défaut le rôle 'user'. On lui affecte la clé étrangère correspondante (relation One to Many)
         */

        $user->role_id = $userRoleId;

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password); // On hashe le mot de passe de l'utilisateur.
        $user->status = UserStatus::PENDING->value; // Le status du compte est mis en mode 'pending' en attendant la validation.
        $user->token = $token; // On affecte le token généré au champ token de la table de l'utilisateur.

        $user->save(); // On enregistre le nouveau utilisateur dans la BDD de manière effective.

        /**
         *  Après avoir crée le compte utilisateur, on déclenche un événement en vue d'envoyer un mail d'activation et de vérification à l'adresse
         *  email fournie par l'utilisateur lors son inscription. On instance un objet de la classe RegisterVerifyEvent avec en argument
         *  l'objet $user. On redirige l'utilisateur vers la page login avec un message flash l'informant qu'un lien d'activation du compte lui a été envoyé.
         */
        event(new RegisterVerifyEvent($user));

        return redirect()->route('home')->with('info', 'Votre nouveau compte doit être activé pour pouvoir vous connecter. Un lien a été envoyé à votre adresse e-mail.');

    }

    /**
     * Méthode pour vérifier si le token et le mail contenu dans le lien cliquable envoyé par mail matchent ceux contenus dans la BDD.
     */
    public function registerVerify($token, $email)
    {

        /**
         *  On vérifie si le token et l'adresse e-mail dans le lien envoyé appartiennent bel et bien à un utilisateur enregistré dans la BDD.
         *  On récupère un objet éloquent $user si la requête trouve l'utilisateur ou null si elle ne trouve rien.
         */


        if(url()->previous() == 'http://localhost:8000/login')
        {
            return redirect()->route('home');
        }


        $user = User::where('token', $token)->where('email', $email)->first();


        /**
         *  Si aucun utilisateur n'est trouvé (parce qu'il aurait par exemple eu une tentative de modification du lien cliquable, on redirige
         * l'utilisateur vers la page d'accueil tout en l'invitant à prendre contact avec nous.
         */

        if (!$user) {
            /**
             * Si on ne trouve pas d'utilisateur dans la BDD parce que le lien est problématique,
             * on redirige l'utilisateur vers la page d'accueil, tout en l'invitant à prendre contact avec nous.
             */
            return redirect()->route('home')->with('error', 'Ce lien n\'est plus valable. Veuillez prendre contact avec nous.');
        }

        // Si la vérification s'est bien déroulée

        $user->status = UserStatus::ACTIVE->value; // On active le compte
        $user->token = ''; //On met le champ token à vide

        $user->update(); // On met à jour les données de l'utilisateur en tenant compte des changements (pending => active, token à vide)

        /**
         * Après avoir activé le nouveau compte de l'utilisateur, on déclenche un événement dans lequel on instancie un objet de la classe
         * RegisterConfirmationListener qui reçoit un objet $user en argument. Cet événement envoit un e-mail confirmant l'activation du compte
         * à l'utilisateur.
         * On redirige l'utilisateur vérifié vers la page login avec un message flash confirmant la vérification et l'activation de son compte.
         */
        event(new RegisterConfirmationEvent($user));

        return redirect()->route('login')->with('success', 'Votre adresse e-mail a été vérifiée et le compte est activé avec succès.');
    }
}
