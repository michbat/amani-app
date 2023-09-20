<?php

namespace App\Http\Controllers\Personnel;

use App\Models\Drink;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\DrinkCreateRequest;
use App\Http\Requests\DrinkEditRequest;

class DrinkPersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drinks =  Drink::orderBy('name')->paginate(10);
        return view('personnel.drinks.index', compact('drinks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('designation', 'Vins')->orWhere('designation', 'Softs')->orWhere('designation', 'Eaux')->orWhere('designation', 'Bières')->orderBy('designation', 'ASC')->get();

        return view('personnel.drinks.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DrinkCreateRequest $request)
    {
        // On vérifie si les données saisies dans la formulaire respectent nos règles de validation définies dans la classe DrinkCreateRequest

        $request->validated();

        // On récupère l'image et on définit le repertoire dans lequel on va stocker l'image

        $image = $request->file('image');
        $path = '/uploads/drink/';

        // On crée un nouvel objet $drink de la classe model 'Drink'

        $drink =  new Drink();

        // On affecte aux variables de l'objet $drink, les valeurs saisies dans le formulaire

        $drink->name = $request->name;
        $drink->slug = Str::slug($request->name, '-');
        $drink->description = $request->description;
        $drink->image = uploadImage($image, $path); // On fait appel à notre fonction helper pour traiter l'image
        $drink->price = $request->price;
        $drink->category_id = $request->category_id;
        $drink->quantityMinimum = $request->quantityMinimum;
        $drink->quantityInStock = $request->quantityInStock;

        $drink->save();

        return redirect()->route('personnel.drinks.index')->with('toast_success', 'La boisson a été ajoutée avec succès');
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
    public function edit(Drink $drink)
    {
        $categories = Category::where('designation', 'Vins')->orWhere('designation', 'Softs')->orWhere('designation', 'Eaux')->orWhere('designation', 'Bières')->orderBy('designation', 'ASC')->get();

        return view('personnel.drinks.edit', compact('drink', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DrinkEditRequest $request, Drink $drink)
    {
        // On vérifie si les données saisies dans la formulaire respectent nos règles de validation définies dans la classe DrinkEditRequest

        $request->validated();

        // On checke si une image a été chargée

        $charged = $request->hasFile('image');

        if ($charged) {
            $image = $request->file('image'); // On récupère l'image dans une variable $image
            $path = '/uploads/drink/';
            $old_path = public_path($drink->image); // On récupère l'ancien chemin vers le dossier où l'image est stockée

        }

        // On affecte aux variables de l'objet $drink, les valeurs saisies dans le formulaire

        $drink->name = $request->name;
        $drink->slug = Str::slug($request->name, '-');
        $drink->description = $request->description;
        $drink->image = $charged ? uploadImage($image, $path, $old_path) : $drink->image;
        $drink->price = $request->price;
        $drink->category_id = $request->category_id;
        $drink->quantityMinimum = $request->quantityMinimum;
        $drink->quantityInStock = $request->quantityInStock;
        $drink->available = $request->available;
        $drink->canBeCommended = $request->canBeCommended;

        $drink->update();

        return redirect()->route('personnel.drinks.index')->with('toast_success', 'La boisson a été mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Drink $drink)
    {
        // On vérifie s'il y a un fichier image lié à l'objet $drink dans le repertoire public/uploads/drink/

        if (file_exists(public_path($drink->image))) {
            unlink(public_path($drink->image));
        }

        $drink->delete();

        return redirect()->route('personnel.drinks.index')->with('toast_success', 'Le menu a été supprimé avec succès');
    }
}
