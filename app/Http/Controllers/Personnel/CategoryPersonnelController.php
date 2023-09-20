<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryEditRequest;
use App\Models\Category;

class CategoryPersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('designation')->get();

        return view('personnel.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personnel.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request)
    {
        // On vérifie si les données saisies dans la formulaire respectent nos règles de validation définies dans la classe CategoryCreateRequest

        $request->validated();

        // On vérifie si une image a été chargé lors de la création d'une catégorie

        if ($request->hasFile('image')) {

            $image = $request->file('image'); // On récupère le fichier image dans une variable $image

            $path = '/uploads/category/'; // On définit le répértoire dans lequel l'image va être stocké.
        }

        $category = new Category(); // On créer un nouvel objet $category de la classe model Category

        $category->designation = $request->designation;
        $category->description = $request->description;
        $category->image = $request->hasFile('image') ? uploadImage($image, $path) : '';

        $category->save();

        return redirect()->route('personnel.categories.index')->with('toast_success', 'La catégorie a été crée avec succès');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('personnel.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryEditRequest $request, Category $category)
    {
        $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = '/uploads/category/';
            $old_path = public_path($category->image);
        }

        $category->designation = $request->designation;
        $category->description = $request->description;
        $category->image = $request->hasFile('image') ? uploadImage($image, $path, $old_path) : $category->image;

        $category->update();

        return redirect()->route('personnel.categories.index')->with('toast_success', 'La catégorie a été mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }

        $category->delete();

        return redirect()->route('personnel.categories.index')->with('toast_success', 'La catégorie a été supprimée');
    }
}
