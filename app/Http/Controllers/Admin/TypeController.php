<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::orderBy('name')->paginate(10);
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // On vérifie si les données saisies respectent nos règles de validation

        $request->validate(
            [
                'name' => 'required|unique:types,name',
            ],
            [
                'name.required' => 'Vous devez donner un nom au nouveau type de produit',
                'name.unique' => 'Ce type de produits existe déjà dans notre base de données',
            ]
        );

        $type = new Type(); // On instancie un objet de la classe model 'Type'

        $type->name = $request->name;

        $type->save();

        return redirect()->route('admin.types.index')->with('toast_success', 'Le type de produits a été ajouté avec succès');
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
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $request->validate(
            [
                'name' => 'required|unique:types,name,' . $type->id, // On empêche d'updater avec un nom existant déjà dans la BDD sauf celui du produit concerné par l'Update
            ],
            [
                'name.required' => 'Vous devez donner un nom au nouveau tag',
                'name.unique' => 'Ce tag existe déjà dans notre base de données',
            ]
        );

        $type->name = $request->name;

        $type->update();

        return redirect()->route('admin.types.index')->with('toast_success', 'Le type de produits a été mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('toast_success', 'Le type de produits a été supprimé avec succès');

    }
}
