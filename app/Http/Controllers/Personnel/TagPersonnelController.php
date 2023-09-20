<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagPersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::orderBy('name')->paginate(10);

        return view('personnel.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personnel.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // On vérifie que nos règles de validation sont respectées

        $request->validate(
            [
                'name' => 'required|unique:tags,name',
            ],
            [
                'name.required' => 'Vous devez donner un nom au nouveau tag',
                'name.unique' => 'Ce tag existe déjà dans notre base de données',
            ]
        );

        $tag = new Tag();

        $tag->name = $request->name;

        $tag->save();

        return redirect()->route('personnel.tags.index')->with('toast_success', 'Le tag a été ajouté avec succès');

    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('personnel.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate(
            [
                'name' => 'required|unique:tags,name,' . $tag->id, // On empêche d'update avec un nom existant déjà dans la BDD sauf celui du produit concerné par l'Update
            ],
            [
                'name.required' => 'Vous devez donner un nom au nouveau tag',
                'name.unique' => 'Ce tag existe déjà dans notre base de données',
            ]
        );

        $tag->name = $request->name;

        $tag->update();

        return redirect()->route('personnel.tags.index')->with('toast_success', 'Le tag a été mis à jour avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('personnel.tags.index')->with('toast_success', 'Le tag a été supprimé avec succès');
    }
}
