<?php

namespace App\Http\Controllers\Admin;

use App\Models\Band;
use App\Models\Show;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shows = Show::orderBy('id', 'DESC')->paginate(5);
        return view('admin.shows.index', compact('shows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bands = Band::orderBy('name')->get();
        return view('admin.shows.create', compact('bands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|unique:shows,title',
                'poster' => 'required|image|mimes:png,jpg,jpeg',
                'description' => 'required',
            ],
            [
                'title.required' => 'Un titre est requis',
                'title.unique' => 'Ce titre est déjà pris',
                'poster.required' => 'Un poster du spectacle est requis',
                'poster.image' => 'Un poster doit-être une image',
                'poster.mimes' => 'Le fichier doit-être au format png,jpg,jpeg',
                'description.required' => 'Une description du spectacle est requise',

            ]
        );

        $poster = $request->file('poster');
        $path = '/uploads/show/';

        $show = new Show();

        $show->title = $request->title;
        $show->band_id = $request->band_id;
        $show->poster = uploadImage($poster, $path);
        $show->description = $request->description;
        $show->isScheduled = $request->isScheduled;

        $show->save();

        return redirect()->route('admin.shows.index')->with('toast_success', 'Le spectacle a été ajouté avec success');
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
    public function edit(Show $show)
    {
        $bands = Band::orderBy('name')->get();
        return view('admin.shows.edit', compact('bands', 'show'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Show $show)
    {
        $request->validate(
            [
                'title' => 'required|unique:shows,title,' . $show->id,
                'description' => 'required',
            ],
            [
                'title.required' => 'Un titre est requis',
                'title.unique' => 'Ce titre est déjà pris',
                'description.required' => 'Une description du spectacle est requise',

            ]
        );

        // On checke si une image a été chargée

        $charged = $request->hasFile('poster');
        $poster =  "";
        // Si oui
        if ($charged) {
            // On valide l'image selon nos règles
            $request->validate(
                [
                    'poster' => 'image|mimes:png,jpg,jpeg',
                ],
                [
                    'poster.image' => 'Un poster doit-être une image',
                    'poster.mimes' => 'Le fichier doit-être au format png,jpg,jpeg',
                ]
            );

            $poster = $request->file('poster'); // On récupère le poster dans une variable $poster
            $path = '/uploads/show/';
            $old_path = public_path($show->poster); // On récupère le chemin absolu vers le dossier où le poster est stocké

        }


        $show->title = $request->title;
        $show->band_id = $request->band_id;
        $show->poster = $charged ? uploadImage($poster, $path, $old_path) : $show->poster;
        $show->description = $request->description;
        $show->isScheduled = $request->isScheduled;

        $show->update();

        return redirect()->route('admin.shows.index')->with('toast_success', 'Le spectacle a été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Show $show)
    {
        if (file_exists(public_path($show->poster))) {
            unlink(public_path($show->poster));
        }

        $show->delete();

        return redirect()->route('admin.shows.index')->with('toast_success', 'Le spectacle a été supprimé');
    }
}
