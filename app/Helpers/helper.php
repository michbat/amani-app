<?php

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

/**
 * La fonction helper uploadImage va nous aider à charger des photos lors de nos opérations CRUD. L'intérêt est
 * d'éviter de repeter la logique de chargement d'un fichier dans chaque contrôleur où l'on en a besoin. Au lieu de travail répétitif,
 * nous allons faire appel à la fonction uploadImage() lorsqu'on aura besoin de charger une photo. Le but est d'alléger , de factoriser le code
 * afin d'augmenter sa bonne maintenabilité.
 */

//  $photo = photo chargée, path= le répertoire où elle va être stocké, $ancien_path = l'ancien répertoire en cas d'update.

function uploadImage($photo, $path, $ancien_path = null): string
{

    // Si une photo est chargée

    if ($photo) {
        // S'il existe déjà un repertoire
        if (file_exists($ancien_path) && $ancien_path != null) {
            // On supprimer l'ancien repertoire et le fichier photo

            unlink($ancien_path);
        }

        $ext = $photo->extension(); // On récupère l'extension de la photo chargée

        $photo_name = time() . '.' . $ext; // On définit un nouveau nom de la photo composé de la fonction time() + extension de la photo chargée

        $url = $path . $photo_name; // Le chemin absolue vers la photo

        // Si le repertoire $path  n'existe pas

        if (!File::isDirectory(public_path($path))) {
            // On le crée

            File::makeDirectory(public_path($path), 0777, true);
        }

        // On stocke l'image dans le répertoire $path en faisant appel à la fonction make() de la librairie Intervention Image qu'on a installée.

        Image::make($photo)->save(public_path($path) . $photo_name);

        return $url;  // On retourne le chemin vers la photo
    }
}
