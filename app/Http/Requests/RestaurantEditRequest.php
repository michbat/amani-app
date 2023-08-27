<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantEditRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)\/]*)$/|min:9',
            'email' => 'email|required',
            'roadName' => 'required',
            'number' => 'numeric|required',
            'postalCode' => 'required',
            'aboutUs' => 'required',
            'city' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom du restaurant est obligatoire',
            'phone.required' => 'Le numéro fixe du restaurant est obligatoire',
            'phone.regex' => 'Veuillez saisir un vrai numéro de téléphone belge. Par exemple: +32 2 345 90 89',
            'email.email' => 'Veuillez saisir une vraie adresse e-mail. Par exemple: contact@contact.com',
            'email.required' => 'L\'adresse e-mail est requise',
            'roadName.required' => 'Le nom de la rue est requis',
            'number.required' => 'Le numéro de la rue est requis',
            'number.numeric' => 'Le numéro de la rue doit-être de format numérique. Par exemple: 43 ',
            'postalCode.required' => 'Le code postal est requis',
            'city.required' => 'Le nom de la ville est requis',
            'aboutUs.required' => 'Vous devez entrer un texte présentant en résumé notre restaurant',
        ];
    }
}
