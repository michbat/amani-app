<?php

namespace App\Http\Controllers\Personnel;

use App\Models\Band;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BandPersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bands = Band::orderBy('id', 'DESC')->paginate(10);

        return view('personnel.bands.index', compact('bands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personnel.bands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:bands,name',
                'member' => 'required|numeric|min:2|max:20',
            ],
            [
                'name.required' => 'Le nom du groupe est obligatoire',
                'name.unique' => 'Ce nom de groupe est déjà dans notre système',
                'member.required' => 'Vous devez indiquer le nombre de membres de ce groupe',
                'member.min' => 'Un groupe doit avoir au minimum 2 membres',
                'member.max' => 'Un groupe doit avoir au maximum 20 membres',
            ]
        );

        $band = new Band();

        $band->name = $request->name;
        $band->member = $request->member;

        $band->save();

        return redirect()->route('personnel.bands.index')->with('toast_success', 'Groupe ajouté avec succès');
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
    public function edit(Band $band)
    {
        return view('personnel.bands.edit', compact('band'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Band $band)
    {
        $request->validate(
            [
                'name' => 'required|unique:bands,name, ' . $band->id,
                'member' => 'required|numeric|min:2|max:20',

            ],
            [
                'name.required' => 'Le nom du groupe est obligatoire',
                'name.unique' => 'Ce nom de groupe est déjà dans notre système',
                'member.required' => 'Vous devez indiquer le nombre de membres de ce groupe',
                'member.min' => 'Un groupe doit avoir au minimum 2 membres',
                'member.max' => 'Un groupe doit avoir au maximum 20 membres',
            ]
        );

        $band->name = $request->name;
        $band->member = $request->member;

        $band->update();

        return redirect()->route('personnel.bands.index')->with('toast_success', 'Groupe mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Band $band)
    {
        $band->delete();
        return redirect()->route('personnel.bands.index')->with('toast_success', 'Groupe supprimé avec succès');
    }
}
