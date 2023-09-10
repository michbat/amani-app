<?php

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

/**
 * La fonction helper uploadImage va nous permettre de charger des images lors de nos opérations CRUD. L'intérêt est
 * d'éviter de repeter la logique de chargement d'une image dans chaque méthode où l'on a besoin de cette logique. Au lieu de cela
 * nous allons faire appel à la fonction uploadImage() lorsqu'on aura besoin de charger une image. Le but est d'alléger le code
 * et d'augmenter sa bonne maintenabilité.
 */

//  $image = image chargée, path= le chemin où elle va être stocké, $old_path = l'ancien chemin en cas d'update.

function uploadImage($image, $path, $old_path = null): string
{

    // Si une image est chargée

    if ($image) {
        // S'il existe déjà un repertoire
        if (file_exists($old_path) && $old_path != null) {
            // On supprimer l'ancien repertoire

            unlink($old_path);
        }

        $ext = $image->extension(); // On récupère l'extension de l'image chargée

        $image_name = time() . '.' . $ext; // On définit un nouveau nom de l'image composé de la fonction time() + extension de l'image chargée

        $url = $path . $image_name; // Le nouveau chemin vers l'image qu'on stockera dans la BDD

        // Si le repertoire $path  n'existe pas

        if (!File::isDirectory(public_path($path))) {
            // On le créer

            File::makeDirectory(public_path($path), 0777, true);
        }

        // On stocke l'image dans le répertoire $path en faisant appel à la fonction make() de la librairie Intervention Image qu'on a installée.

        Image::make($image)->save(public_path($path) . $image_name);

        return $url;
    }
}

function getCartItemModel($cartItem)
{
    if ($cartItem->product_type === 'menu') {
        return $cartItem->associatedModel; // This will return the associated Menu model
    } elseif ($cartItem->product_type === 'drink') {
        return $cartItem->associatedModel; // This will return the associated Drink model
    }

    return null; // Handle other cases or errors as needed
}
