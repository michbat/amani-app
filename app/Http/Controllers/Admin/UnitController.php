<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::orderBy('name')->get();
        return view('admin.units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.units.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:units,name',
                'symbol' => 'required|unique:units,symbol',
            ],
            [
                'name.required' => 'Vous devez indiquer le nom de l\'unité de mesure',
                'name.unique' => 'Cette unité de mesure existe déjà dans la base de données',
                'symbol.required' => 'Vous devez indiquer le symbole de \'unité de mesure. Par exemple: Kg, L, etc.',
                'symbol.unique' => 'Ce symbole a déjà été attribué à une unité de mesure',

            ]
        );

        $unit = new Unit();

        $unit->name = $request->name;
        $unit->symbol = $request->symbol;

        $unit->save();

        return redirect()->route('admin.units.index')->with('toast_success', 'L\'unité de mesure et son symbole ont été ajoutés');

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
    public function edit(Unit $unit)
    {
        return view('admin.units.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $request->validate(
            [
                'name' => 'required|unique:units,name,' . $unit->id,
                'symbol' => 'required|unique:units,symbol,' . $unit->id,
            ],
            [
                'name.required' => 'Vous devez indiquer le nom de l\'unité de mesure',
                'name.unique' => 'Cette unité de mesure existe déjà dans la base de données',
                'symbol.required' => 'Vous devez indiquer le symbole de \'unité de mesure. Par exemple: Kg, L, etc.',
                'symbol.unique' => 'Ce symbole a déjà été attribué à une unité de mesure',

            ]
        );

        $unit->name = $request->name;
        $unit->symbol = $request->symbol;

        $unit->update();

        return redirect()->route('admin.units.index')->with('toast_success', 'L\'unité de mesure et son symbole ont été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('admin.units.index')->with('toast_success', 'L\'unité de mesure et son symbole ont été supprimés');
    }
}
