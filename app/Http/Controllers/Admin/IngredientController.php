<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StockStatus;
use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use App\Models\Type;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredients = Ingredient::orderBy('name')->paginate(10);
        return view('admin.ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::orderBy('name')->get();
        $units = Unit::orderBy('name')->get();
        $stockStatus = StockStatus::cases();

        return view('admin.ingredients.create', compact('types', 'units', 'stockStatus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'name' => 'required|unique:ingredients,name',
                'quantityInStock' => 'required|numeric',
                'quantityMinimum' => 'required|numeric',
                'stockStatus' => ['required', new Enum(StockStatus::class)],
            ],
            [
                'name.required' => 'Vous devez indiquer le nom de l\'ingrédient',
                'name.unique' => 'Ce nom est déjà dans la base de données',
                'quantityInStock.required' => 'Vous devez indiquer la quantité que vous voulez introduire en stock',
                'quantityInStock.numeric' => 'La quantité doit être sous format numérique',
                'quantityMinimum.required' => 'Vous devez indiquer le seuil minimum exigé',
                'quantityMinimum.numeric' => 'La quantité doit être sous format numérique',
                'stockStatus.required' => 'Vous devez indiquer le status de disponibilité de cet ingredient',

            ]
        );

        $ingredient = new Ingredient();

        $ingredient->name = $request->name;
        $ingredient->quantityInStock = $request->quantityInStock;
        $ingredient->quantityMinimum = $request->quantityMinimum;
        $ingredient->stockStatus = $request->stockStatus;
        $ingredient->type_id = $request->type_id;
        $ingredient->unit_id = $request->unit_id;

        $ingredient->save();



        return redirect()->route('admin.ingredients.index')->with('toast_success', 'L\'ingrédient a été crée avec succès');

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
    public function edit(Ingredient $ingredient)
    {
        $types = Type::orderBy('name')->get();
        $units = Unit::orderBy('name')->get();
        return view('admin.ingredients.edit', compact('ingredient', 'types', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate(
            [
                'name' => 'required|unique:ingredients,name,' . $ingredient->id,
                'quantity' => 'required|numeric',
            ],
            [
                'name.required' => 'Vous devez indiquer le nom de l\'ingrédient',
                'name.unique' => 'Ce nom est déjà dans la base de données',
                'quantity.required' => 'Vous devez indiquer la quantité que vous voulez introduire en stock',
                'quantity.numeric' => 'La quantité doit être sous format numérique',
            ]
        );

        $ingredient->name = $request->name;
        $ingredient->quantity = $request->quantity;
        $ingredient->type_id = $request->type_id;
        $ingredient->unit_id = $request->unit_id;

        $ingredient->update();

        return redirect()->route('admin.ingredients.index')->with('toast_success', 'L\'ingrédient a été mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return redirect()->route('admin.ingredients.index')->with('toast_success', 'L\'ingrédient a été supprimé avec succès');
    }
}
