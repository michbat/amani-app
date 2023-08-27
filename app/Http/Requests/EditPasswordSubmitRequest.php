<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class EditPasswordSubmitRequest extends FormRequest
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
        // On définit des règles de validation
        return [
            'password_old' => 'required|min:6',
            'password_new' => 'required|min:6',
            'password_confirmation' => 'required|same:password_new',
        ];

    }

    public function messages(): array
    {
        // Les messages qui seront diffusés si jamais des règles de validation ne sont pas respectées.
        return [
            'password_old.required' => 'Votre mot de passe actuel est requis',
            'password_old.min' => 'Le mot de passe doit avoir au minimum 6 caractères',

            'password_new.required' => 'Vous devez saisir un nouveau mot de passe',
            'password_new.min' => 'Votre nouveau mot de passe doit avoir au minimum 6 caractères',

            'password_confirmation.required' => 'Vous devez confirmer votre mot de passe',
            'password_confirmation.same' => 'Veuillez saisir encore votre nouveau mot de passe',
        ];
    }

    /**
     * Avant de changer son mot de passe, un utilisateur doit saisir son mot de passe actuel. Je dois donc créer une règle de
     * validation qui surveille si l'utilisateur saisit bien son mot de passe actuel qu'il souhaite changer dans son dashboard,
     * étant donné que Laravel ne nous fournit pas cette règle de validation.
     */

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $pwd_check = Hash::check(request()->password_old, request()->user()->password);
                $same_pwd = request()->password_old == request()->password_new ? true : false;

                // Si les mots de passe sont différents ($pwd_check = false)

                if (!$pwd_check) {
                    //On lève notre propre erreur
                    $validator->errors()->add('password_old', 'Veuillez SVP saisir votre mot de passe actuel');
                }

                // Si l'ancien mot de passe est le même que le nouveau mot de passe, on lève une erreur (les deux doivent être différents)

                if ($same_pwd) {
                    $validator->errors()->add('password_new', 'Vous devez saisir un mot de passe différent de l\'ancien');
                }
            },
        ];
    }
}
