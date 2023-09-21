<?php

namespace App\Http\Controllers\Admin;

use App\Models\Band;
use App\Models\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artists = Artist::orderBy('name')->paginate(10);

        return view('admin.artists.index', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bands = Band::orderBy('name')->get();

        return view('admin.artists.create', compact('bands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:artists,name',
            ],
            [
                'name.required' => 'Le nom de l\'artiste est requis',
                'name.unique' => 'Ce nom d\'artiste est déjà pris',
            ]
        );

        $artist =  new Artist();

        $artist->name = $request->name;
        $artist->band_id = $request->band_id;

        $artist->save();

        return redirect()->route('admin.artists.index')->with('toast_success', 'L\'artiste a été ajouté');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        $bands = Band::orderBy('name')->get();

        return view('admin.artists.edit', compact('bands', 'artist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $request->validate(
            [
                'name' => 'required|unique:artists,name,' . $artist->id,
            ],
            [
                'name.required' => 'Le nom de l\'artiste est requis',
                'name.unique' => 'Ce nom d\'artiste est déjà pris',
            ]
        );

        $artist->name = $request->name;
        $artist->band_id = $request->band_id;

        $artist->save();

        return redirect()->route('admin.artists.index')->with('toast_success', 'L\'artiste mis à jour avec succès');
    }

    /**
     *
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();

        return redirect()->route('admin.artists.index')->with('toast_success', 'L\'artiste a été supprimé');
    }
}
