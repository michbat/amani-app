<?php

namespace App\Http\Controllers\Personnel;

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

class PlatPersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Je récupère les enregistrements de la table "plats" triés par ordre alphabétique sous forme d'un tableau d'objets de type "Plat" et les affiche sur des pages où chaque page contient 10 plats. La relati

        /**
         * Je récupère les enregistrements de la table "plats" triés par ordre alphabétique sous forme d'un tableau d'objets de type
         * "Plat" et les affiche sur des pages où chaque page contient 10 plats.
         */

        $plats = Plat::with('ingredients')->orderBy('name')->paginate(10);

        // Je retourne la vue "index" dans laquelle j'injecte le tableau d'objets de type "Plat"

        return view('personnel.plats.index', compact('plats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Je récupère les enregistrements des tables "categories" et "ingredients" triés par ordre alphabétique sous forme de tableaux d'objets.

        $categories = Category::orderBy('designation')->get();
        $ingredients = Ingredient::orderBy('name')->get();

        // Je retourne la vue "create" tout en injectant ces collections d'objets dans cette vue.

        return view('personnel.plats.create', compact('categories', 'ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlatCreateRequest $request)
    {
        // Je vérifie si les données saisies dans la formulaire de création d'un plat respectent des règles de validation que j'ai définies dans la classe request PlatCreateRequest

        $request->validated();

        // Je récupère l'image et je définis le chemin du dossier dans lequel je vais stocker l'image

        $image = $request->file('image');
        $path = '/uploads/plat/';

        $plat = new Plat(); // Je crée un nouvel objet $plat de la classe modèle 'Plat'.

        // J'affecte aux propriétés de l'objet $plat des valeurs saisies dans le formulaire

        $plat->name = $request->name;
        $plat->slug = Str::slug($request->name, '-');  // La méthode statique slug() de la classe Str permet créer un slug
        $plat->description = $request->description;
        $plat->image = uploadImage($image, $path); // Je fais appel à ma fonction helper pour traîter l'image
        $plat->price = $request->price;
        $plat->available = $request->available;
        $plat->category_id = $request->category_id;
        $plat->restaurant_id = Restaurant::where('name', 'Amani')->first()->id;

        // Je récupère une collection d'ingrédients que j'ai choisis d'associer à mon plat puis je parcours chaque élément de la collection pour récupérer la quantité (amount) de chaque ingrédient choisi qui, alors, est retournée dans un tableau associatif (clé => valeur).

        $ingredients = collect($request->input('ingredients', []))->map(function ($amount) {
            return ['amount' => $amount];
        });

        $plat->save();  // Je sauve mon objet $plat, c'est à dire, j'enregistre les données saisies dans le formulaire dans la BDD

        $plat->ingredients()->sync($ingredients);  // J'associe l'ensemble de tableaux associatifs contenant des quantités des ingrédients composant le plat crée en faisant appel à la méthode sync()

        // Je retourne la vue "index" contenant la liste de nos plats.

        return redirect()->route('personnel.plats.index')->with('toast_success', 'Le plat a été ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plat $plat)
    {
        // Je récupère une collection d'objets (les enregistrements de la table "tags" triés par ordre alphabétique) de la classe modèle "Tag" classé par leur noms
        $tags = Tag::orderBy('name')->get();

        // Je retourne la vue "show "tout en injectant le tableau d'objets et l'objet $plat concerné par ces tags.

        return view('personnel.plats.show', compact('plat', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plat $plat)
    {
        // Je récupère l'ensemble de mes catégories (les enregistrements de la table "categories" triés par ordre alphabetique) sous forme d'un tableau d'objets de type "Category"

        $categories = Category::orderBy('designation')->get();

        // Je récupère les enregistrements dans la table "tags" triés par ordre alphabétique  (sous forme d'un tableau d'objets de type "Tag")

        $tags = Tag::orderBy('name')->get();

        $plat->load('ingredients');  // la méthode load() pré-charge des ingrédients associés au plat que je cherche à mettre à jour


        // Je récupère d'abord les enregistrements de la table "ingredients" triés par ordre alphabétique puis j'utilise la méthode map() pour parcourir chaque ingrédient de la collection récupérée. firstWhere vérifie si l'ingredient parcouru fait parti des ingrédients du plat que je cherche à éditer. Si c'est le cas, je recupère la quantité de cet ingrédient qui se trouve dans la table pivot "ingredient_plat" puis je retourne l'objet $ngredient" qui s'ajoute alors au tableau d'ingredients composant le plat en cours d'édition. Si ce n'est pas le cas, c'est null qui est retourné.

        $ingredients = Ingredient::orderBy('name')->get()->map(function ($ingredient) use ($plat) {
            $ingredient->value = data_get($plat->ingredients->firstWhere('id', $ingredient->id), 'pivot.amount') ?? null;
            return $ingredient;
        });

        // Je retourne la vue "edit" dans laquelle on injecte des objets dont je veux afficher les propriétés dans la vue via l'interpolation

        return view('personnel.plats.edit', compact('plat', 'categories', 'tags', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlatEditRequest $request, Plat $plat)
    {
        // Je vérifie si les données de mise à jour saisies dans le formulaire respectent nos règles de validation définies dans la classe PlatEditRequest

        $request->validated();

        // Je vérifie si une image a été chargée

        $charged = $request->hasFile('image');

        // Si c'est le cas

        if ($charged) {
            $image = $request->file('image'); // Je récupère l'image dans une variable $image
            $path = '/uploads/plat/';  // Je définis le dossier dans lequel on va la stocker
            $old_path = public_path($plat->image); // Je récupère le chemin absolu vers le dossier dans lequel l'image actuelle est stockée

        }

        // J'update les informations

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

        $plat->update(); // Je rends effective cette mise à jour dans la BDD

        $plat->ingredients()->sync($ingredients); // J'associe des ingrédients au plat mis à jour

        // Je retourne à l'index

        return redirect()->route('personnel.plats.index')->with('toast_success', 'Le plat a été mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plat $plat)
    {
        // Je vérifie si le fichier image du plat existe dans notre dossier

        if (file_exists(public_path($plat->image))) {
            // Si oui, j'efface ce fichier du répertoire
            unlink(public_path($plat->image));
        }

        $plat->delete();  // Je supprime l'objet de type "Plat" concerné donc j'efface dans la BDD la ligne d'enregistrement concerné

        // Je retourne à l'index

        return redirect()->route('personnel.plats.index')->with('toast_success', 'Le plat a été supprimé avec succès');
    }

    // Méthode qui assigne un tableau de tags au plat

    public function assignTags(Request $request, Plat $plat)
    {
        // J'assigne au plat un tableau de tags choisis en utilisant la méthode sync()

        $plat->tags()->sync($request->tags);

        // Je reste sur la vue d'affectation de tags avec un message flash (toast) de succès.

        return back()->with('toast_success', 'Le(s) tag(s) a (ont) été ajouté(s) au plat');
    }

    // Méthode qui enlève un tag associé à ce plat

    public function removeTag(Plat $plat, Tag $tag)
    {
        // La méthode hasTag() a été définie dans la classe modèle "Tag"

        // Je vérifie si, effectivement, le plat a le tag que je veux enlèver

        if ($plat->hasTag($tag->name)) {
            $plat->tags()->detach($tag);  // J'enlève le tag en utilisant la méthode detach()
            return back()->with('toast_success', 'Le tag a été supprimé avec success');  // J'affiche un message confirmant le détachement
        }

        // Si jamais le tag n'est pas associé au plat, on affiche un message flash informatif.

        return redirect()->back()->with('toast_info', 'Ce tag n\'est pas assigné à ce plat');
    }
}
