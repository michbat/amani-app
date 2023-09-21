<?php

namespace App\Http\Controllers\Admin;

use App\Models\Band;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Music;

class BandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bands = Band::orderBy('id', 'DESC')->paginate(10);

        return view('admin.bands.index', compact('bands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bands.create');
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

        return redirect()->route('admin.bands.index')->with('toast_success', 'Groupe ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Band $band)
    {
        $musics = Music::orderBy('style')->get();

        return view('admin.bands.show', compact('band', 'musics'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Band $band)
    {
        return view('admin.bands.edit', compact('band'));
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

        return redirect()->route('admin.bands.index')->with('toast_success', 'Groupe mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Band $band)
    {
        $band->delete();
        return redirect()->route('admin.bands.index')->with('toast_success', 'Groupe supprimé avec succès');
    }

    // Méthode qui assigne un tableau de styles de musique au groupe

    public function assignMusics(Request $request, Band $band)
    {
        // J'assigne au plat un tableau de tags choisis en utilisant la méthode sync()

        $band->musics()->sync($request->musics);

        // Je reste sur la vue d'affectation de tags avec un message flash (toast) de succès.

        return back()->with('toast_success', 'Le(s) style(s) de musique a (ont) été ajouté(s) au groupe');
    }

    // Méthode qui enlève un style de musique associé à ce groupe

    public function removeMusic(Band $band, Music $music)
    {
        // La méthode hasMusic() a été définie dans la classe modèle "Band"

        // Je vérifie si, effectivement, le groupe a le style de musique que je veux enlèver

        if ($band->hasMusic($music->style)) {
            $band->musics()->detach($music);  // J'enlève le style de musique en utilisant la méthode detach()
            return back()->with('toast_success', 'Le style de musique a été supprimé avec success');  // J'affiche un message confirmant le détachement
        }

        // Si jamais le style de musique n'est pas associé au plat, on affiche un message flash informatif.

        return redirect()->back()->with('toast_info', 'Ce style de musique n\'est pas assigné à ce groupe');
    }
}
