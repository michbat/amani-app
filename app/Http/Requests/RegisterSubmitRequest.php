<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterSubmitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */

    //  Méthode où l'on définit nos règles de validation

    public function rules(): array
    {
        return [
            'firstname' => 'required|string|min:2|max:60',
            'lastname' => 'required|string|min:2|max:60',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)\/]*)$/|min:9|unique:users,phone',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'g-recaptcha-response' => 'required|captcha'
        ];
    }

    // Méthode où l'on définit des messages d'erreurs

    public function messages(): array
    {
        return [
            'lastname.required' => 'Le nom est requis',
            'lastname.string' => 'Le nom doit être composé de lettres uniquement',
            'lastname.min' => 'Le nom doit être composé d\'au moins 2 lettres',
            'lastname.max' => 'Le nom doit être composé de 60 lettres au plus',

            'firstname.required' => 'Le prénom est requis',
            'firstname.string' => 'Le prénom doit être composé de lettres uniquement',
            'firstname.min' => 'Le prénom doit être composé d\'au moins 2 lettres',
            'firstname.max' => 'Le prénom doit être composé de 60 lettres au plus',

            'email.required' => 'L\'adresse e-mail est requise',
            'email.email' => 'Fournissez une adresse e-mail valide. par exemple: dupond@gmail.com',
            'email.unique' => 'Cette adresse e-mail est déjà prise',

            'phone.required' => 'Le numéro de téléphone est requis',
            'phone.min' => 'Le numéro de téléphone doit composetr au moins 9 chiffres',
            'phone.regex' => 'Fournissez un numéro de téléphone valide',
            'phone.unique' => 'Ce numéro de téléphone est déjà pris',


            'password.required' => 'Le mot de passe est requis',
            'password.min' => 'Le mot de passe doit être composé d\'au moins 6 caractères',
            'password_confirmation.required' => 'Vous devez confirmer votre mot de passe',
            'password_confirmation.same' => 'Veuillez entrer le même mot de passe que celui saisi précédemment',

            'g-recaptcha-response.required' => 'Nous devons vérifier que vous n\'êtes pas un robot!',
            'g-recaptcha-response.captcha' => 'Erreur du Captcha! Essayez encore ou contactez-nous via le numéro de téléphone ou l\'email',

        ];
    }
}
