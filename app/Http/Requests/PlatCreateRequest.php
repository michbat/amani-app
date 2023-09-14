<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlatCreateRequest extends FormRequest
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
            'name' => 'required|unique:plats,name',
            'description' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'ingredients.*' => 'numeric',
            'ingredients' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vous devez donner un nom à votre nouveau plat',
            'name.unique' => 'Ce plat existe déjà dans notre système',
            'description.required' => 'Vous devez faire une description de votre plat',
            'image.required' => 'Une image de votre plat est nécessaire',
            'image.image' => 'Veuillez charger une image svp',
            'image.mimes' => 'L\'image doit être au format png,jpg,jpeg',
            'price.required' => 'Vous devez indiquer un prix pour votre plat',
            'price.numeric' => 'Le prix doit être au format numérique',
            'ingredient.*' => 'Vous devez choisir des ingrédients (et leurs quantités) pour chaque plat crée',
            'ingredients.required' => 'Vous devez ajouter des ingrédients (et leurs quantités) pour chaque plat crée',

        ];
    }
}
