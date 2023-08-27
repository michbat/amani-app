<?php

namespace App\Http\Controllers\Admin;

use App\Enums\GalleryType;
use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryCreateRequest;
use App\Http\Requests\GalleryEditRequest;
use App\Models\Gallery;
use App\Models\Restaurant;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::orderBy('title')->paginate(10);

        return view('admin.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = GalleryType::cases();
        return view('admin.galleries.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryCreateRequest $request)
    {
        // On vérifie si les données respectent nos règles de validation

        $request->validated();

        // On récupère le fichier image et détermine le repertoire dans lequel il va être sauvegardé.

        $image = $request->file('image');
        $path = '/uploads/gallery/';

        $gallery = new Gallery();

        $gallery->title = $request->title;
        $gallery->image = uploadImage($image, $path);
        $gallery->galleryType = $request->galleryType;
        $gallery->videoId = $request->galleryType === GalleryType::VIDEO->value ? $request->videoId : '';
        $gallery->restaurant_id = Restaurant::where('name', 'Amani')->first()->id;

        $gallery->save();

        return redirect()->route('admin.galleries.index')->with('toast_success', 'Le média a été ajouté à la galerie');

    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        $types = GalleryType::cases();
        return view('admin.galleries.edit', compact('gallery', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryEditRequest $request, Gallery $gallery)
    {
        // On vérifie si les données de mise à jour respectent nos règles de validation définies dans la classe RecipeEditRequest
        $request->validated();

        // On checke si une image a été chargée

        $charged = $request->hasFile('image');
        if ($charged) {
            $image = $request->file('image'); // On récupère l'image dans une variable $image
            $path = '/uploads/gallery/';
            $old_path = public_path($gallery->image); // On récupère le chemin vers le dossier où l'image est stockée

        }

        // On met à jour les informations

        $gallery->title = $request->title;
        $gallery->image = $charged ? uploadImage($image, $path, $old_path) : $gallery->image;
        $gallery->galleryType = $request->galleryType;
        $gallery->videoId = $request->galleryType === GalleryType::VIDEO->value ? $request->videoId : '';

        $gallery->update();

        return redirect()->route('admin.galleries.index')->with('toast_success', 'Le média a été édité avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        if (file_exists(public_path($gallery->image))) {
            unlink(public_path($gallery->image));
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('toast_success', 'Le média a été supprimée de la galerie');
    }
}
