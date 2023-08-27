<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResentLinkSubmitRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Votre adresse e-mail est requise',
            'email.email' => 'Saisissez une vraie adresse e-mail. Par exemple: tom@tom.com',
            'email.exists' => 'Cette adresse e-mail n\'est pas enregistrée dans notre système',
        ];
    }
}
