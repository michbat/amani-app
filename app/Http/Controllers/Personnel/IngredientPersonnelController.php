<?php

namespace App\Http\Controllers\Personnel;

use App\Enums\StockStatus;
use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use App\Models\Type;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class IngredientPersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredients = Ingredient::orderBy('name')->paginate(10);
        return view('personnel.ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::orderBy('name')->get();
        $units = Unit::orderBy('name')->get();
        $stockStatus = StockStatus::cases();

        return view('personnel.ingredients.create', compact('types', 'units', 'stockStatus'));
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
                'quantityMinimum' => ['required', 'numeric', 'stock_check'],
                'stockStatus' => ['required', new Enum(StockStatus::class)],
            ],
            [
                'name.required' => 'Vous devez indiquer le nom de l\'ingrédient',
                'name.unique' => 'Ce nom est déjà dans la base de données',
                'quantityInStock.required' => 'Vous devez indiquer la quantité que vous voulez introduire en stock',
                'quantityInStock.numeric' => 'La quantité doit être sous format numérique',
                'quantityMinimum.required' => 'Vous devez indiquer le seuil minimum exigé',
                'quantityMinimum.numeric' => 'La quantité doit être sous format numérique',
                'quantityMinimum.stock_check' => 'Le seuil de quantité minimale dans le stock doit être 3x inférieure au stock principal ',
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



        return redirect()->route('personnel.ingredients.index')->with('toast_success', 'L\'ingrédient a été crée avec succès');
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
        $stockStatus = StockStatus::cases();
        return view('personnel.ingredients.edit', compact('ingredient', 'types', 'units', 'stockStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate(
            [
                'name' => 'required|unique:ingredients,name,' . $ingredient->id,
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

        $ingredient->name = $request->name;
        $ingredient->quantityInStock = $request->quantityInStock;
        $ingredient->quantityMinimum = $request->quantityMinimum;
        $ingredient->stockStatus = $request->stockStatus;
        $ingredient->type_id = $request->type_id;
        $ingredient->unit_id = $request->unit_id;

        // À la mise à jour, on vérifie si quanity stock est strictement supérieur à quantityMinimu auquel cas,
        // On met la propriété stockStatus à AVAILABLE
        // Les menus liés à cet ingrédient redeviennent disponibles à la commande

        if ($request->quantityInStock > $request->quantityMinimum) {
            $ingredient->stockStatus = StockStatus::AVAILABLE->value;
            foreach ($ingredient->menus as $menu) {
                $menu->available =  1;
                $menu->update();
            }
        }


        $ingredient->update();

        return redirect()->route('personnel.ingredients.index')->with('toast_success', 'L\'ingrédient a été mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return redirect()->route('personnel.ingredients.index')->with('toast_success', 'L\'ingrédient a été supprimé avec succès');
    }
}
