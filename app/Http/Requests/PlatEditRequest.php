<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlatEditRequest extends FormRequest
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
            'name' => 'required|unique:plats,name,' . $this->plat->id,
            'description' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'ingredients.*' => 'numeric',
            'ingredients' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vous devez donner un nom à votre plat',
            'name.unique' => 'Ce palt existe déjà dans notre système',
            'description.required' => 'Vous devez faire une description de votre plat',
            'image.image' => 'Veuillez charger une image svp',
            'image.mimes' => 'L\'image doit être au format png,jpg,jpeg',
            'price.required' => 'Vous devez indiquer un prix pour votre plat',
            'price.numeric' => 'Le prix doit être au format numérique',
            'ingredients.*' => 'Vous devez choisir des ingrédients (et leurs quantités) pour ce plat',
            'ingredients.required' => 'Vous devez ajouter des ingrédients (et leurs quantités) pour ce plat',
        ];
    }
}
