<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Mail\AmaniRestaurantMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)\/]*)$/|min:9',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password',

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
                'email.unique' => 'Cette adresse e-mail est déjà prise',

                'phone.required' => 'Le numéro de téléphone est requis',
                'phone.min' => 'Le numéro de téléphone doit composetr au moins 9 chiffres',
                'phone.regex' => 'Fournissez un numéro de téléphone valide',
                'password.required' => 'Le mot de passe est requis',
                'password.min' => 'Le mot de passe doit être composé d\'au moins 6 caractères',
                'password_confirmation.required' => 'Vous devez confirmer votre mot de passe',
                'password_confirmation.same' => 'Veuillez entrer le même mot de passe que celui saisi précédemment',

            ]);

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
        $user->password = Hash::make($request->password); // On hashe le mot de passe de l'utilisateur pour la sécurité.
        $user->status = UserStatus::PENDING->value; // Le status du compte est mis en mode 'pending' en attendant la validation.
        $user->token = $token; // On affecte le token généré au champ token de la table de l'utilisateur.

        $user->save(); // On enregistre le nouveau utilisateur dans la BDD de manière effective.

        // Création et envoie par mail du lien de vérification et d'activation du compte du nouveau utilisateur enregistré dans la BDD.

        $verification_link = url('register-verify/' . $user->token . '/' . $request->email);

        $subject = 'Confirmation de votre nouveau compte';
        $message = 'Bonjour, <br><br> Bienvenu(e) sur notre site.<br>Veuillez cliquer sur ce lien pour activer votre compte:  ';
        $message .= '<a href= "' . $verification_link . '">Cliquez ici</a><br> Votre mot de passe par défaut est: ' . $request->password . '<br> Changez-le en vous connectant sur votre compte dès que possible! <br><br> Cordialement, <br><br> Amani Resto.';
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
                'email' => 'required|email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)\/]*)$/|min:9',
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

                'phone.required' => 'Le numéro de téléphone est requis',
                'phone.min' => 'Le numéro de téléphone doit composetr au moins 9 chiffres',
                'phone.regex' => 'Fournissez un numéro de téléphone valide',

                'role_id.required' => 'Vous devez donner un rôle à l\'utilisateur',

                'status.required' => 'Veuillez préciser le status du compte.',

            ]);

        // dd($request->all());

        $user->role_id = $request->role_id;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->token = '';

        $user->update();

        // Un e-mail à l'utilisateur s'il y a eu une mise à jour de ses informations de base par nous-même.

        $subject1 = 'Confirmation de la mise à jour des informations de votre compte';
        $message1 = 'Bonjour,<br><br>Nous vous informons de la mise à jour des informations de votre compte <b>activé</b>.<br>';
        $message1 .= 'En espérant vous revoir bientôt.<br><br> Cordialement, <br><br> Amani Resto.';
        $view = 'mails.account_activation_mail';

        // Un email à l'utilisateur si son compte a été suspendu.

        $subject2 = 'Suspension de votre compte';
        $message2 = 'Bonjour, <br><br> Nous vous informons que votre compte utilisateur a été suspendu pour non-respect des règles d\'utilisation.<br>';
        $message2 .= 'Vous ne pouvez plus vous connecter sur notre site.<br>';
        $message2 .= 'Veuillez prendre contact avec nous pour de plus âpres informations.<br><br>';
        $message2 .= 'Cordialement, <br><br> Amani Resto.';

        if ($user->status->value === UserStatus::PENDING->value) {
            Mail::to($request->email)->send(new AmaniRestaurantMail($subject2, $message2, $view));

        } else {

            Mail::to($request->email)->send(new AmaniRestaurantMail($subject1, $message1, $view));
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

}
