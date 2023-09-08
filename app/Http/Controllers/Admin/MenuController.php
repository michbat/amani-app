<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuEditRequest;
use App\Http\Requests\MenuCreateRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::with('ingredients')->orderBy('name')->paginate(10);
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('designation')->get();
        $ingredients = Ingredient::orderBy('name')->get();
        return view('admin.menus.create', compact('categories', 'ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuCreateRequest $request)
    {
        // On vérifie si les données saisies dans la formulaire respectent nos règles de validation définies dans la classe RecipeCreateRequest

        $request->validated();

        // On récupère l'image et on définit le repertoire dans lequel on va stocker l'image

        $image = $request->file('image');
        $path = '/uploads/menu/';

        $menu = new Menu(); // On crée un nouvel objet $menu de la classe model 'Menu'.

        // On affecter aux variables de l'objet $menu, les valeurs saisies dans le formulaire
        
        $menu->name = $request->name;
        $menu->slug = Str::slug($request->name, '-');
        $menu->description = $request->description;
        $menu->image = uploadImage($image, $path); // On fait appel à notre fonction helper pour traîter l'image
        $menu->price = $request->price;
        $menu->available = $request->available;
        $menu->category_id = $request->category_id;
        $menu->restaurant_id = Restaurant::where('name', 'Amani')->first()->id;

        $ingredients = collect($request->input('ingredients', []))->map(function ($amount) {
            return ['amount' => $amount];
        });

        $menu->save();

        $menu->ingredients()->sync($ingredients);
        return redirect()->route('admin.menus.index')->with('toast_success', 'Le menu a été ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        $tags = Tag::orderBy('name')->get();
        return view('admin.menus.show', compact('menu', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $categories = Category::orderBy('designation')->get();
        $tags = Tag::orderBy('name')->get();

        $menu->load('ingredients');

        $ingredients = Ingredient::orderBy('name')->get()->map(function ($ingredient) use ($menu) {
            $ingredient->value = data_get($menu->ingredients->firstWhere('id', $ingredient->id), 'pivot.amount') ?? null;
            return $ingredient;
        });
        return view('admin.menus.edit', compact('menu', 'categories', 'tags', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuEditRequest $request, Menu $menu)
    {
        // On vérifie si les données de mise à jour respectent nos règles de validation définies dans la classe RecipeEditRequest
        $request->validated();

        // On checke si une image a été chargée

        $charged = $request->hasFile('image');
        if ($charged) {
            $image = $request->file('image'); // On récupère l'image dans une variable $image
            $path = '/uploads/menu/';
            $old_path = public_path($menu->image); // On récupère le chemin vers le dossier où l'image est stockée

        }

        // On met à jour les informations

        $menu->name = $request->name;
        $menu->slug = Str::slug($request->name, '-');
        $menu->description = $request->description;
        $menu->image = $charged ? uploadImage($image, $path, $old_path) : $menu->image;
        $menu->price = $request->price;
        $menu->available = $request->available;
        $menu->category_id = $request->category_id;

        $ingredients = collect($request->input('ingredients', []))->map(function ($amount) {
            return ['amount' => $amount];
        });

        $menu->update(); // On rend effectif cette mise à jour

        $menu->ingredients()->sync($ingredients); //On ajoute les ingrédients de la recette mis à jour dans la page pivot 'ingredient_menu'

        return redirect()->route('admin.menus.index')->with('toast_success', 'Le menu a été mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        if (file_exists(public_path($menu->image))) {
            unlink(public_path($menu->image));
        }

        $menu->delete();

        return redirect()->route('admin.menus.index')->with('toast_success', 'Le menu a été supprimé avec succès');
    }

    // Méthode qui assigne un tableau de tags au menu

    public function assignTags(Request $request, Menu $menu)
    {
        $menu->tags()->sync($request->tags);

        return back()->with('toast_success', 'Le(s) tag(s) a (ont) été ajouté(s) au menu');
    }

    // Mtéhode qui enlève un tag specifique à une rectte

    public function removeTag(Menu $menu, Tag $tag)
    {
        if ($menu->hasTag($tag->name)) {
            $menu->tags()->detach($tag);
            return back()->with('toast_success', 'Le tag a été supprimé avec success');
        }

        return back()->with('toast_info', 'Ce tag n\'est pas assigné à ce menu');
    }
}
