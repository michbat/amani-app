<?php

namespace App\Http\Controllers\Personnel;

use App\Models\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;

class TablePersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nt = Table::all()->count();
        $tables = Table::orderBy('id', 'ASC')->paginate(5);
        return view('personnel.tables.index', compact('tables','nt'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = Table::all()->count();
        return view('personnel.tables.create', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'seat' => 'required|integer|between:3,6',
            ],
            [
                'seat.required' => 'Vous devez indiquer le nombre de places assises pour cette table',
                'seat.between' => 'Entre 3 et 6 places assises',
            ]
        );

        $table = new Table();

        $nt = Table::all()->count() + 1;
        $rid = Restaurant::all()[0]->id;

        $table->restaurant_id = $rid;
        $table->code = "TABLE-00" . $nt;
        $table->seat = $request->seat;

        $table->save();

        return redirect()->route('personnel.tables.index')->with('toast_success', 'Table ajoutée');
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
    public function edit(Table $table)
    {
        return view('personnel.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Table $table)
    {
        $request->validate(
            [
                'seat' => 'required|integer|between:3,6',
            ],
            [
                'seat.required' => 'Vous devez indiquer le nombre de places assises pour cette table',
                'seat.between' => 'Entre 3 et 6 places assises',
            ]
        );

        $table->seat = $request->seat;

        $table->update();

        return redirect()->route('personnel.tables.index')->with('toast_success', 'Table éditée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {
        $table->delete();
        return redirect()->route('personnel.tables.index')->with('toast_success', 'Table supprimée');
    }

    /**
     * Méthode pour attribuer une table ou pas
     */

    public function setIsFree(Table $table)
    {
        $table->isFree = !$table->isFree;
        $table->update();

        if ($table->isFree) {
            return redirect()->back()->with('toast_success', 'Table libérée');
        } else {
            return redirect()->back()->with('toast_success', 'Table occupée');
        }
    }
}
