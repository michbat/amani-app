<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditProfileSubmitRequest extends FormRequest
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
            // L'adresse e-mail doit être unique dans la table 'users' mais cette règle ne s'applique pas à l'utilisateur connecté lorqu'il veut éditer son adresse e-mail puisqu'il peut faire le choix de garder son adresse e-mail courante.
            'email' => ['required','email',Rule::unique('users')->ignore($this->user()->id,'id')],
            // Le numéro de téléphone doit être unique dans la table 'users' mais cette règle ne s'applique pas à l'utilisateur connecté lorsqu'il veut éditer son numéro de téléphone puisqu'il peut faire le choix de garder son numéro de téléphone courant. 
            'phone' => ['required','regex:/^([0-9\s\-\+\(\)\/]*)$/','min:9',Rule::unique('users')->ignore($this->user()->id,'id')],
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
        ];
    }
}
