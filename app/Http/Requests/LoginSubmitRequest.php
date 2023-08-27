<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginSubmitRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email', // email valide, doit être de type 'email' et exister dans la BDD
            'password' => 'required|min:6', // mot de passé requis et de taille minimum 6
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'L\'adresse e-mail est requise pour se connecter',
            'email.email' => 'Veuillez saisir une adresse e-mail valide',
            'email.exists' => 'Cette adresse e-mail n\'existe pas dans notre système',
            'password.required' => 'Le mot de passe est requis pour se connecter',
            'password.min' => 'Le mot de passe doit être composé au minimum de 6 caractères',
        ];
    }
}
