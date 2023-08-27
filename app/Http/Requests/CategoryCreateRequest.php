<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
            'image' => 'image|mimes:png,jpg,jpeg',
            'designation' => 'required|unique:categories,designation',
            'description' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'image.image' => 'Vous devez charger une image',
            'image.mimes' => 'Uniquement des images au format png,jpg,jpeg',
            'designation.required' => 'Vous devez donner un nom à votre nouvelle catégorie',
            'designation.unique' => 'Cette designation est déjà présente dans la base de données',
            'description.required' => 'Vous devez donner une description de votre catégorie',
        ];
    }
}
