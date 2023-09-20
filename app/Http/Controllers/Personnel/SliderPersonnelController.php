<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderCreateRequest;
use App\Http\Requests\SliderEditRequest;
use App\Models\Restaurant;
use App\Models\Slider;

class SliderPersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('personnel.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personnel.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderCreateRequest $request)
    {
        // On vérifie si les données saisies respectent nos règles de validation

        $request->validated();

        // Traiter le fichier image

        $image = $request->file('image');
        $path = '/uploads/slider/';

        $slider = new Slider();

        $slider->title = $request->title;
        $slider->content = $request->content;
        $slider->image = uploadImage($image, $path);
        $slider->restaurant_id = Restaurant::where('name', 'Amani')->first()->id;

        $slider->save();

        return redirect()->route('personnel.sliders.index')->with('toast_success', 'Le slider a été ajouté avec succès');
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
    public function edit(Slider $slider)
    {
        return view('personnel.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderEditRequest $request, Slider $slider)
    {
        $request->validated();

        // Si une autre image a été chargéeq
        $charged = $request->hasFile('image');
        if ($charged) {
            $image = $request->file('image'); // On récupère la nouvelle image
            $path = '/uploads/slider/';
            $old_path = public_path($slider->image); // On récupère l'ancien répértoire
        }

        $slider->title = $request->title;
        $slider->content = $request->content;
        $slider->image = $request->hasFile('image') ? uploadImage($image, $path, $old_path) : $slider->image;
        $slider->restaurant_id = Restaurant::where('name', 'Amani')->first()->id;

        $slider->update();

        return redirect()->route('personnel.sliders.index')->with('toast_success', 'Le slider a été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        if (file_exists(public_path($slider->image))) {
            unlink(public_path($slider->image));
        }

        $slider->delete();

        return redirect()->route('personnel.sliders.index')->with('toast_success', 'Le slider a été supprimé');
    }
}
