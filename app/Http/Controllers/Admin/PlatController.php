<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Menu;
use App\Models\Plat;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlatEditRequest;
use App\Http\Requests\PlatCreateRequest;

class PlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plats = Plat::with('ingredients')->orderBy('name')->paginate(10);
        return view('admin.plats.index', compact('plats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('designation')->get();
        $ingredients = Ingredient::orderBy('name')->get();
        return view('admin.plats.create', compact('categories', 'ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlatCreateRequest $request)
    {
        // On vérifie si les données saisies dans la formulaire respectent nos règles de validation définies dans la classe RecipeCreateRequest

        $request->validated();

        // On récupère l'image et on définit le repertoire dans lequel on va stocker l'image

        $image = $request->file('image');
        $path = '/uploads/plat/';

        $plat = new Plat(); // On crée un nouvel objet $menu de la classe model 'Menu'.

        // On affecter aux variables de l'objet $menu, les valeurs saisies dans le formulaire

        $plat->name = $request->name;
        $plat->slug = Str::slug($request->name, '-');
        $plat->description = $request->description;
        $plat->image = uploadImage($image, $path); // On fait appel à notre fonction helper pour traîter l'image
        $plat->price = $request->price;
        $plat->available = $request->available;
        $plat->category_id = $request->category_id;
        $plat->restaurant_id = Restaurant::where('name', 'Amani')->first()->id;

        $ingredients = collect($request->input('ingredients', []))->map(function ($amount) {
            return ['amount' => $amount];
        });

        $plat->save();

        $plat->ingredients()->sync($ingredients);
        return redirect()->route('admin.plats.index')->with('toast_success', 'Le plat a été ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plat $plat)
    {
        $tags = Tag::orderBy('name')->get();
        return view('admin.plats.show', compact('plat', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plat $plat)
    {
        $categories = Category::orderBy('designation')->get();
        $tags = Tag::orderBy('name')->get();

        $plat->load('ingredients');

        $ingredients = Ingredient::orderBy('name')->get()->map(function ($ingredient) use ($plat) {
            $ingredient->value = data_get($plat->ingredients->firstWhere('id', $ingredient->id), 'pivot.amount') ?? null;
            return $ingredient;
        });
        return view('admin.plats.edit', compact('plat', 'categories', 'tags', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlatEditRequest $request, Plat $plat)
    {
        // On vérifie si les données de mise à jour respectent nos règles de validation définies dans la classe
        $request->validated();

        // On checke si une image a été chargée

        $charged = $request->hasFile('image');
        if ($charged) {
            $image = $request->file('image'); // On récupère l'image dans une variable $image
            $path = '/uploads/plat/';
            $old_path = public_path($plat->image); // On récupère le chemin vers le dossier où l'image est stockée

        }

        // On met à jour les informations

        $plat->name = $request->name;
        $plat->slug = Str::slug($request->name, '-');
        $plat->description = $request->description;
        $plat->image = $charged ? uploadImage($image, $path, $old_path) : $plat->image;
        $plat->price = $request->price;
        $plat->available = $request->available;
        $plat->category_id = $request->category_id;

        $ingredients = collect($request->input('ingredients', []))->map(function ($amount) {
            return ['amount' => $amount];
        });

        $plat->update(); // On rend effectif cette mise à jour

        $plat->ingredients()->sync($ingredients); //On ajoute les ingrédients de la recette mis à jour dans la page pivot 'ingredient_menu'

        return redirect()->route('admin.plats.index')->with('toast_success', 'Le plat a été mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plat $plat)
    {
        if (file_exists(public_path($plat->image))) {
            unlink(public_path($plat->image));
        }

        $plat->delete();

        return redirect()->route('admin.plats.index')->with('toast_success', 'Le plat a été supprimé avec succès');
    }

    // Méthode qui assigne un tableau de tags au menu

    public function assignTags(Request $request, Plat $plat)
    {
        $plat->tags()->sync($request->tags);

        return back()->with('toast_success', 'Le(s) tag(s) a (ont) été ajouté(s) au plat');
    }

    // Mtéhode qui enlève un tag specifique à une rectte

    public function removeTag(Plat $plat, Tag $tag)
    {
        if ($plat->hasTag($tag->name)) {
            $plat->tags()->detach($tag);
            return back()->with('toast_success', 'Le tag a été supprimé avec success');
        }

        return back()->with('toast_info', 'Ce tag n\'est pas assigné à ce plat');
    }
}
