<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:galleries,title,' . $this->gallery->id,
            'image' => 'image|mimes:png,jpg,jpeg',
            'galleryType' => 'required',
            'videoId' => 'required_if:galleryType,video|unique:galleries,videoId,' . $this->gallery->id,
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Le titre du média est requis',
            'title.unique' => 'Ce titre est déjà présent dans notre base de données',
            'image.image' => 'Veuillez charger une vraie image svp',
            'image.mimes' => 'L\'image doit-être de format png,jpg,jpeg',
            'galleryType.required' => 'Veuillez indiquer le type du média que vous voulez ajouter dans la galerie',
            'videoId.required_if' => 'L\'ID de la vidéo est requis si le type de médias choisi est la vidéo',
            'videoId.unique' => 'Cet ID de la vidéo est déjà présent dans notre base de données',
        ];
    }
}
