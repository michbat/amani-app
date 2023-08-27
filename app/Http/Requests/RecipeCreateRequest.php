<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeCreateRequest extends FormRequest
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
            'name' => 'required|unique:recipes,name',
            'description' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'ingredients.*' => 'numeric',
            'ingredients' => 'required|array',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vous devez donner un nom à votre recette',
            'name.unique' => 'Cette recette existe déjà dans la liste',
            'description.required' => 'Vous devez faire une description de votre recette',
            'image.required' => 'Une image de votre recette est nécessaire',
            'image.image' => 'Veuillez charger une image svp',
            'image.mimes' => 'L\'image doit être au format png,jpg,jpeg ou gif',
            'price.required' => 'Vous devez indiquer un prix pour votre recette',
            'price.numeric' => 'Le prix doit être au format numérique',
            'ingredient.*' => 'Vous devez choisir des ingrédients (et leurs quantités) pour chaque recette crée',
            'ingredients.required' => 'Vous devez ajouter des ingrédients (et leurs quantités) pour chaque recette crée',
            'ingredients.array' => 'Les ingrédients doivent se trouver dans un tableau Array pour être traîtés',

        ];
    }
}
