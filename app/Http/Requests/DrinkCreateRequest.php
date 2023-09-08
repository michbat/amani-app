<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DrinkCreateRequest extends FormRequest
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
            'name' => 'required|unique:drinks,name',
            'description' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'quantityInStock' => 'required|numeric',
            'quantityMinimum' => ['required', 'numeric', 'stock_check'],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Vous devez donner un nom à la boisson',
            'name.unique' => 'Cette boisson existe déjà dans la liste',
            'description.required' => 'Vous devez faire une description de la boisson',
            'image.required' => 'Une image de votre boisson est nécessaire',
            'image.image' => 'Veuillez charger une image svp',
            'image.mimes' => 'L\'image doit être au format png,jpg,jpeg',
            'price.required' => 'Vous devez indiquer un prix pour la boisson',
            'price.numeric' => 'Le prix doit être au format numérique',
            'category_id.required' => 'Vous devez choisir une catégorie pour la boisson',
            'quantityInStock.required' => 'Veuillez indiquer la quantité à ajouter dans le stock',
            'quantityInStock.numeric' => 'Cette quantité doit être au format numérique',
            'quantityMinimum.required' => 'Vous devez indiquer le seuil de quantité minimale dans le stock',
            'quantityMinimum.numeric' => 'Cette quantité minimale doit être au format numérique',
            'quantityMinimum.stock_check' => 'Le seuil de quantité minimale doit être 3 fois inférieure à la quantité du produit en stock',

        ];
    }
}
