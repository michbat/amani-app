<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordSubmitRequest extends FormRequest
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
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'La saisie d\'un nouveau mot de passe est requise',
            'password.min' => 'Le nouveau mot de passe doit au moins avoir 6 caractères',
            'password_confirmation.required' => 'Vous devez confirmer votre nouveau mot de passe',
            'password_confirmation.same' => 'Saisissez le même mot de passe pour confirmer',
        ];
    }
}
