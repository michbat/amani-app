<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Enums\UserStatus;
use Illuminate\Http\Request;
use App\Mail\AmaniRestaurantMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Events\EditProfileSubmitEvent;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // On récupère tous les utilisateurs sauf l'utilisateur dont le rôle est admin pour ne pas prendre le risque de le supprimer par inadvertance et de ne plus accéder à la page d'administration.

        $users = User::all()->except(Auth::id()); // On récupère tous les utilisateurs sauf celui qui se connecte (c'est à dire ici l'admin)
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        /**
         * On vérifie d'abord si les données saisies respectent nos règles de validation.
         * Des messages d'erreur s'affichent si les données saisies ne respectent pas cess règles.
         */

        $request->validate(
            [
                'firstname' => 'required|string|min:2|max:60',
                'lastname' => 'required|string|min:2|max:60',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)\/]*)$/|min:9|unique:users,phone',
                // 'password' => 'required|min:6',
                // 'password_confirmation' => 'required|same:password',

            ],
            [
                'lastname.required' => 'Le nom est requis',
                'lastname.string' => 'Le nom doit être composé de lettres uniquement',
                'lastname.min' => 'Le nom doit être composé d\'au moins 2 lettres',
                'lastname.max' => 'Le nom doit être composé de 60 lettres au plus',

                'firstname.required' => 'Le prénom est requis',
                'firstname.string' => 'Le prénom doit être composé de lettres uniquement',
                'firstname.min' => 'Le prénom doit être composé d\'au moins 2 lettres',
                'firstname.max' => 'Le prénom doit être composé de 60 lettres au plus',

                'email.required' => 'L\'adresse e-mail est requise',
                'email.email' => 'Fournissez une adresse e-mail valide. par exemple: jean@gmail.com',
                'email.unique' => 'Cette adresse e-mail est déjà enregistrée dans notre système',

                'phone.required' => 'Le numéro de téléphone est requis',
                'phone.min' => 'Le numéro de téléphone doit composetr au moins 9 chiffres',
                'phone.regex' => 'Fournissez un numéro de téléphone valide',
                'phone.unique' => 'Ce numéro est déjà enregistré dans notre système',

            ]
        );

        // On genère un nouveau token pour le besoin de vérification et d'activation du compte via un lien cliquable ebvoyé par e-mail

        $token = hash('sha256', time());

        // On crée un nouvel utilisateur en instanciant un nouvel objet $user de la classe Model 'User'

        $user = new User();

        // On recupère la clé primaire du role qui a pour nom 'user'
        $userRoleId = Role::where('name', 'user')->first()->id;

        // On enregistre les données saisies par le nouveau utilisateur dans la BDD

        // Le nouveau utilisateur enregistré a par défaut le rôle 'user'. On lui affecte donc une clé étrangère correspondante
        $user->role_id = $userRoleId;

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $pwd = self::generatePassword(); // Nous avons besoin de recueillir le password généré en clair pour l'envoyer à l'utilisateur.
        $user->password = Hash::make($pwd); // On hashe le mot de passe généré par notre méthode statique utilitaire
        $user->status = UserStatus::PENDING->value; // Le status du compte est mis en mode 'pending' en attendant la validation.
        $user->token = $token; // On affecte le token généré au champ token de la table de l'utilisateur.

        $user->save(); // On enregistre le nouveau utilisateur dans la BDD de manière effective.

        // Création et envoie par mail du lien de vérification et d'activation du compte du nouveau utilisateur enregistré dans la BDD.

        $verification_link = url('register-verify/' . $user->token . '/' . $request->email);

        $subject = 'Confirmation de votre nouveau compte';
        $message = 'Bonjour, <br><br> Bienvenu(e) sur notre site.<br>Veuillez cliquer sur ce lien pour activer votre compte:  ';
        $message .= '<a href= "' . $verification_link . '">Cliquez ici</a><br> Votre mot de passe par défaut est: ' . $pwd . '<br> Changez-le en vous connectant sur votre compte dès que possible! <br><br> Cordialement, <br><br> Amani Resto.';
        $view = 'mails.account_activation_mail';

        // Envoi de l'email. On met en paramètre de la méthode send() un objet de la classe AmaniRestaurantMail qui reçoit 3 paramètres (voir la classe en question dans le sous-dossier Mail/ du dossier app/)

        Mail::to($request->email)->send(new AmaniRestaurantMail($subject, $message, $view));

        // On revient à l'index des utilisateurs.

        return redirect()->route('admin.users.index')->with('toast_success', 'Le nouveau utilisateur crée avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // dd($user->firstname);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // On selectionne tous les rôles sauf celui de l'administrateur

        $roles = Role::whereNotIn('name', ['admin'])->orderBy('name')->get();
        $ustatuts = UserStatus::cases();
        return view('admin.users.edit', compact('user', 'roles', 'ustatuts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validation des données

        $request->validate(
            [
                'firstname' => 'required|string|min:2|max:60',
                'lastname' => 'required|string|min:2|max:60',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)\/]*)$/|min:9|unique:users,phone,' . $user->id,
                'role_id' => 'required',
                'status' => 'required',

            ],
            [
                'lastname.required' => 'Le nom est requis',
                'lastname.string' => 'Le nom doit être composé de lettres uniquement',
                'lastname.min' => 'Le nom doit être composé d\'au moins 2 lettres',
                'lastname.max' => 'Le nom doit être composé de 60 lettres au plus',

                'firstname.required' => 'Le prénom est requis',
                'firstname.string' => 'Le prénom doit être composé de lettres uniquement',
                'firstname.min' => 'Le prénom doit être composé d\'au moins 2 lettres',
                'firstname.max' => 'Le prénom doit être composé de 60 lettres au plus',

                'email.required' => 'L\'adresse e-mail est requise',
                'email.email' => 'Fournissez une adresse e-mail valide. par exemple: jean@gmail.com',
                'email.unique' => 'Cet e-mail est déjà enregistré dans notre système',

                'phone.required' => 'Le numéro de téléphone est requis',
                'phone.min' => 'Le numéro de téléphone doit composetr au moins 9 chiffres',
                'phone.regex' => 'Fournissez un numéro de téléphone valide',
                'phone.unique' => 'Ce numéro de téléphone est déjà enregistré dans notre système',

                'role_id.required' => 'Vous devez donner un rôle à l\'utilisateur',

                'status.required' => 'Veuillez préciser le status du compte.',

            ]
        );

        $user->role_id = $request->role_id;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;

        /**
         * Si l'administrateur met à jour l'adresse e-mail, il faut relancer le processus de vérification pour cette nouvelle adresse
         */
        if ($user->email != $request->email) {

            $token = hash('sha256', time());  // On génère un token

            $user->token = $token; // On affecte le token au champ token de la table 'users' de la  BDD
            $user->status = UserStatus::PENDING; // On met le status du compte à "pending"
            $user->email = $request->email; // On affecte la nouvelle adresse e-mail au champ e-mail

            $user->update(); // On rend effectif ces changements

            // On declenche un événement afin d'envoyer à l'utiliser un lien cliquable de vérification à sa nouvelle adresse e-mail

            event(new EditProfileSubmitEvent($user));
        } else {

            $user->email = $request->email;
            $user->status = $request->status;
            $user->token = '';
            $user->update();

            // Un e-mail à l'utilisateur s'il y a eu une mise à jour de ses informations de base par nous-même.


            if ($user->status === UserStatus::ACTIVE) {
                $subject1 = 'Compte actif et information à jour';
                $message1 = 'Bonjour, <br><br>Votre compte est actif et vos informations à jour.<br>';
                $message1 .= 'En espérant vous revoir bientôt.<br><br> Cordialement, <br><br> Amani Resto.';
                $view = 'mails.account_activation_mail';
                Mail::to($user->email)->send(new AmaniRestaurantMail($subject1, $message1, $view));
            }

            // Un email à l'utilisateur si son compte a été suspendu.

            if ($user->status === UserStatus::PENDING) {

                $subject2 = 'Suspension de votre compte';
                $message2 = 'Bonjour, <br><br> Nous vous informons que votre compte utilisateur a été suspendu.<br>';
                $message2 .= 'Vous ne pouvez plus vous connecter sur notre site.<br>';
                $message2 .= 'Veuillez prendre contact avec nous pour de plus âpres informations.<br><br>';
                $message2 .= 'Cordialement, <br><br> Amani Resto.';
                $view = 'mails.account_activation_mail';
                Mail::to($user->email)->send(new AmaniRestaurantMail($subject2, $message2, $view));
            }
        }




        // On revient à l'index des utilisateurs.

        return redirect()->route('admin.users.index')->with('toast_success', 'Le compte utilisateur a été mis à jour!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //Si jamais l'utilisateur à supprimer a un rôle 'admin', on empêche sa suppression.

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.users.index')->with('toast_warning', 'Vous tentez de supprimer un admin! Impossible de le supprimer!');
        }

        $user->delete(); // Suppression de l'utilisateur

        // On envoit un e-mail de confirmation de la suppression de son compte.

        $subject = 'Suppression de votre compte';
        $message = 'Bonjour,<br><br>Nous avons supprimé votre compte. Vous ne pouvez plus vous connecter sur notre site avec des identifiants liés à ce compte.<br><br>Bien à vous, <br><br> Amani Resto.';
        $view = 'mails.account_activation_mail';
        Mail::to($user->email)->send(new AmaniRestaurantMail($subject, $message, $view));

        // Redirection vers la page index des utilisateurs.

        return redirect()->route('admin.users.index')->with('toast_success', 'L\'utilisateur a été supprimé de la base de données');
    }

    // Générateur de mots de passe aléatoire

    private static function generatePassword($minLength = 8) : string
    {
        $password = '';

        $specialCharacters = '!?@#&~$*';
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789' . $specialCharacters;

        $password .= $characters[random_int(0, 25)]; // Ajouter au moins une lettre majuscule
        $password .= $characters[random_int(26, 51)]; // Ajouter au moins une lettre minuscule
        $password .= $characters[random_int(52, 61)]; // Ajouter au moins un chiffre entre 0 et 9
        $password .= $specialCharacters[random_int(0, strlen($specialCharacters) - 1)]; // Ajouter au moins un caractère spécial

        // On remplit le reste de caractères manquant c'est à dire  4 (8-4)
        while (strlen($password) < $minLength) {
            $randomChar = $characters[random_int(0, strlen($characters) - 1)];
            $password .= $randomChar;
        }

        // On mixe par hasard les caractères composant le mot passe crée.

        $password = str_shuffle($password);


        return $password;  // On renvoit le mot de passe.
    }
}
