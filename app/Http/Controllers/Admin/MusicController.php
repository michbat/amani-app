<?php

namespace App\Http\Controllers\Admin;

use App\Models\Music;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $musics = Music::orderBy('style')->paginate(10);
        return view('admin.musics.index', compact('musics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.musics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'style' => 'required|unique:musics,style',
            ],
            [
                'style.required' => 'Vous devez donner un nom de style de musique',
                'style.unique' => 'Ce style se trouve déjà dans notre système'
            ]
        );

        $music = new Music();

        $music->style = $request->style;

        $music->save();

        return redirect()->route('admin.musics.index')->with('toast_success', 'Le style de musique ajouté avec succès');
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
    public function edit(Music $music)
    {
        return view('admin.musics.edit', compact('music'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Music $music)
    {
        $request->validate(
            [
                'style' => 'required|unique:musics,style,' . $music->id,
            ],
            [
                'style.required' => 'Vous devez donner un nom de style de musique',
                'style.unique' => 'Ce style se trouve déjà dans notre système'
            ]
        );

        $music->style = $request->style;

        $music->update();

        return redirect()->route('admin.musics.index')->with('toast_success', 'Le style de musique mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Music $music)
    {
        $music->delete();

        return redirect()->route('admin.musics.index')->with('toast_success', 'Le style de musique a été supprimé');
    }
}
