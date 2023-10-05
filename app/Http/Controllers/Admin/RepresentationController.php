<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Show;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\Representation;
use App\Http\Controllers\Controller;

class RepresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $representations =  Representation::orderBy('representationDate', 'DESC')->paginate(10);
        
        return view('admin.representations.index', compact('representations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // On récupère l'ensemble des shows
        $shows = Show::orderBy('id', 'DESC')->get();

        return view('admin.representations.create', compact('shows'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // On applique nos règles de validation. Si une date est déjà prise, elle ne peut plus faire objet d'une programmation.

        $request->validate(
            [
                'representationDate' => 'required|unique:representations,representationDate',
                'startTime' => 'required',
                'endTime' => 'required|after:startTime',
            ],
            [
                'representationDate.required' => 'La date est requise',
                'representationDate.unique' => 'Cette date est déjà prise',
                'startTime.required' => 'Indiquez l\'heure du début du spectacle',
                'endTime.required' => 'Indiquez l\'heure de fin du spectacle',
                'endTime.after' => 'L\'heure de fin doit être postérieure à l\'heure de début',
            ]
        );


        $representation = new Representation();
        $representation->restaurant_id = Restaurant::all()[0]->id;
        $representation->show_id = $request->show_id;
        $representation->representationDate = Carbon::parse($request->representationDate)->format('Y-m-d');
        $representation->startTime = Carbon::parse($request->startTime)->format('H:i');
        $representation->endTime = Carbon::parse($request->endTime)->format('H:i');

        $representation->save();

        return redirect()->route('admin.representations.index')->with('toast_success', 'Programmation ajoutée avec succès');
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
    public function edit(Representation $representation)
    {
        // On récupère l'ensemble des shows
        $shows = Show::orderBy('id', 'DESC')->get();

        return view('admin.representations.edit', compact('shows', 'representation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Representation $representation)
    {
        // On applique nos règles de validation

        $request->validate(
            [
                'representationDate' => 'required|unique:representations,representationDate,' . $representation->id,
                'startTime' => 'required',
                'endTime' => 'required|after:startTime',
            ],
            [
                'representationDate.required' => 'La date est requise',
                'representationDate.unique' => 'Cette date est déjà prise',
                'startTime.required' => 'Indiquez l\'heure du début du spectacle',
                'endTime.required' => 'Indiquez l\'heure de fin du spectacle',
                'endTime.after' => 'L\'heure de fin doit être postérieure à l\'heure de début',
            ]
        );


        $representation->restaurant_id = Restaurant::all()[0]->id;
        $representation->show_id = $request->show_id;
        $representation->representationDate = Carbon::parse($request->representationDate)->format('Y-m-d');
        $representation->startTime =  Carbon::parse($request->startTime)->format('H:i');
        $representation->endTime = Carbon::parse($request->endTime)->format('H:i');
        $representation->canceled = $request->canceled;

        $representation->update();


        return redirect()->route('admin.representations.index')->with('toast_success', 'Programmation éditée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Representation $representation)
    {
        $representation->delete();

        return redirect()->route('admin.representations.index')->with('toast_success', 'Programmation supprimée avec succès');
    }
}
