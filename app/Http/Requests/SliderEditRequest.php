<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderEditRequest extends FormRequest
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
            'title' => 'required|unique:sliders,title,' . $this->slider->id,
            'content' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Le titre du slider est requis',
            'title.unique' => 'Ce titre est déjà présent dans notre base de données',
            'content.required' => 'Le slider doit avoir un contenu',
            'image.image' => 'Veuillez charger une image',
            'image.mimes' => 'Vous devez charger des fichiers d\'images au format png,jpg,jpeg',
        ];
    }
}
