<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DrinkEditRequest extends FormRequest
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
            'name' => 'required|unique:drinks,name,' . $this->drink->id,
            'description' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'available' => 'required',
            'canBeCommended' => 'required',
            // 'quantityInStock' => ['required', 'numeric', 'greater_than_minimum:quantityMinimum'],
            'quantityInStock' => ['required', 'numeric'],
            'quantityMinimum' => ['required', 'numeric'],
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
            // 'quantityInStock.greater_than_minimum' => 'La quantité en stock doit être supérieure au seuil de quantité minimale',
            'quantityMinimum.required' => 'Vous devez indiquer le seuil de quantité minimale dans le stock',
            'quantityMinimum.numeric' => 'Cette quantité minimale doit être au format numérique',
            'available.required' => 'Vous devez indiquer si le produit est disponibkle ou pas',
            'canBeCommended.required' => 'Vous devez indiquer si le produit peut faire l\'objet de commandes',


        ];
    }
}
