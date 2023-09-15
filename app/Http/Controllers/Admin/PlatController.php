<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
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
        // On récupère les enregistrements de la table "plats" triés par ordre alphabétique sous forme d'un tableau d'objets de type "Plat" et les affiche sous forme de pages où chaque page contient 10 plats.

        $plats = Plat::with('ingredients')->orderBy('name')->paginate(10);

        // On retourne la vue "index" dans laquelle on injecte le tableau d'objets de type "Plat"
        return view('admin.plats.index', compact('plats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // On récupère des enregistrements des  tables "categories" et "ingredients" triés par ordre alphabétique sous forme de tableaux d'objets de types respectifs.

        $categories = Category::orderBy('designation')->get();
        $ingredients = Ingredient::orderBy('name')->get();

        // On retourne la vue "create" tout en injectant nos tableaux d'objets dans cette vue.

        return view('admin.plats.create', compact('categories', 'ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlatCreateRequest $request)
    {
        // On vérifie si les données saisies dans la formulaire de création d'un plat respectent nos règles de validation définies dans la classe request PlatCreateRequest

        $request->validated();

        // On récupère l'image et on définit le repertoire dans lequel on va stocker l'image

        $image = $request->file('image');
        $path = '/uploads/plat/';

        $plat = new Plat(); // On crée un nouvel objet $plat de la classe modèle 'Plat'.

        // On affecte aux propriétés de l'objet $plat des valeurs saisies dans le formulaire

        $plat->name = $request->name;
        $plat->slug = Str::slug($request->name, '-');  // La méthode statique slug () de la classe Str permet créer un slug
        $plat->description = $request->description;
        $plat->image = uploadImage($image, $path); // On fait appel à notre fonction helper pour traîter l'image
        $plat->price = $request->price;
        $plat->available = $request->available;
        $plat->category_id = $request->category_id;
        $plat->restaurant_id = Restaurant::where('name', 'Amani')->first()->id;

        // On récupère une collection d'ingrédients qu'on a choisis d'associer à notre plat dans le formulaire puis on parcourt chaque élément de la collection pour récupérer la quantité (amount) de chaque ingrédient choisi qui, alors, est retournée dans un tableau associatif (clé => valeur).

        $ingredients = collect($request->input('ingredients', []))->map(function ($amount) {
            return ['amount' => $amount];
        });

        $plat->save();  // On sauve notre objet $plat c'est à dire on enregistre les données saisies dans le formulaire dans la BDD

        $plat->ingredients()->sync($ingredients);  // On associe l'ensemble de tableaux associatifs contenant des quantités des ingrédients composant le plat crée en faisant appel à la méthode sync()

        // On retourne la vue "index" contenant la liste de nos plats (sous forme d'un tableau)

        return redirect()->route('admin.plats.index')->with('toast_success', 'Le plat a été ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plat $plat)
    {
        // On récupère une collection d'objets (les enregistrements de la table "tags" triés par ordre alphabétique) de la classe modèle "Tag" classé par leur noms
        $tags = Tag::orderBy('name')->get();

        // On retourne la vue "show "tout en injectant le tableau d'objets et l'objet $plat concerné par ces tags.

        return view('admin.plats.show', compact('plat', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plat $plat)
    {
        // On récupère l'ensemble de nos catégories (les enregistrements de la table "categories" triés par ordre alphabetique) sous forme d'un tableau d'objets de type "Category"

        $categories = Category::orderBy('designation')->get();

        // On récupère les enregistrements dans la table "tags" triés par ordre alphabétique  (sous forme d'un tableau d'objets de type "Tag")

        $tags = Tag::orderBy('name')->get();

        $plat->load('ingredients');  // la méthode load() pré-charge des ingrédients associés au plat qu'on cherche à mettre à jour


        // On récupère d'abord les enregistrements de la table "ingredients" triés par ordre alphabétique puis on utilise la méthode map() pour parcourir chaque ingrédient de la collection récupérée. firstWhere vérifie si l'ingredient parcouru fait parti des ingrédients composant le plat que l'on veut à éditer. Si c'est le cas, on recupère la quantité de cette ingrédient qui se trouve dans la table pivot "ingredient_plat" puis l'objet $ngredient" dans la collection $ingredients. Si ce n'est pas le cas, c'est null qui est retourné.

        $ingredients = Ingredient::orderBy('name')->get()->map(function ($ingredient) use ($plat) {
            $ingredient->value = data_get($plat->ingredients->firstWhere('id', $ingredient->id), 'pivot.amount') ?? null;
            return $ingredient;
        });

        // On retourne la vue "edit" dans laquelle on injecte objets pour lequels on veut afficher la valeur des propriétés dans cette vue (par interpolation {{  }})

        return view('admin.plats.edit', compact('plat', 'categories', 'tags', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlatEditRequest $request, Plat $plat)
    {
        // On vérifie si les données de mise à jour saisies dans le formulaire respectent nos règles de validation définies dans la classe PlatEditRequest

        $request->validated();

        // On checke si une image a été chargée

        $charged = $request->hasFile('image');

        // Si c'est le cas

        if ($charged) {
            $image = $request->file('image'); // On récupère l'image dans une variable $image
            $path = '/uploads/plat/';  // On défini le dossier dans lequel on va la stocker
            $old_path = public_path($plat->image); // On récupère le chemin absolu du dossier où l'image  actuelle est stockée

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

        $plat->update(); // On rend effectif cette mise à jour dans la BDD

        $plat->ingredients()->sync($ingredients); // On ajoute les ingrédients du plat  mis à jour

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

    // Méthode qui assigne un tableau de tags au plat

    public function assignTags(Request $request, Plat $plat)
    {
        $plat->tags()->sync($request->tags);

        return back()->with('toast_success', 'Le(s) tag(s) a (ont) été ajouté(s) au plat');
    }

    // Méthode qui enlève un tag associé à ce plat

    public function removeTag(Plat $plat, Tag $tag)
    {
        // La méthode hasTag() a été définie dans la classe modèle "Tag"

        if ($plat->hasTag($tag->name)) {
            $plat->tags()->detach($tag);  // On enlève le tag en utilisant la méthode detach()
            return back()->with('toast_success', 'Le tag a été supprimé avec success');  // On affiche un message confirmant cette suppression
        }

        // Si jamais le tag n'est pas associé au plat, on affiche un message ad hoc

        return redirect()->back()->with('toast_info', 'Ce tag n\'est pas assigné à ce plat');
    }
}
