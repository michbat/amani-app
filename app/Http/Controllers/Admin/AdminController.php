<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plat;
use App\Models\User;
use App\Models\Drink;
use App\Models\Order;
use App\Models\Table;
use App\Models\Ingredient;
use App\Models\Restaurant;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $plats = Plat::all()->count();  // On récupère le nombre de plats
        $drinks = Drink::all()->count(); // On récupère le nombre de boissons
        $users = User::all()->count(); // On récupère le nombre de compte d'utilisateurs
        $ingredients = Ingredient::all()->count(); // On récupère le nombre d'ingrédients en stock
        $opened =  Restaurant::all()[0]->opened;
        $orders = Order::all(); // On récupére le nombre de commandes effectuées
        $tables = Table::all();

        $nbrOrders = $orders->count();
        $nbrTables = $tables->count();



        $turnover = 0;   // Chiffres d'affaire totale
        $tax = 0;   // TVA
        $occupiedTable = 0;  // tables occupées

        foreach ($orders as $order) {
            $turnover += $order->total;
            $tax += $order->tva;
        }

        foreach ($tables as $table) {
            if ($table->isFree == 0) {
                $occupiedTable += 1;
            }
        }

        return view('admin.index', compact('plats', 'drinks', 'users', 'opened', 'turnover', 'tax', 'ingredients', 'nbrOrders', 'occupiedTable', 'nbrTables'));
    }

    /**
     *  Open/Close restaurant method
     */

    public function OpenCloseRestaurant()
    {
        $restaurant = Restaurant::all()[0];  // On récupère l'objet restaurant
        $restaurant->opened = !$restaurant->opened;  // On toggle la propriété opened (le champ opened dans la BDD)

        $restaurant->update();  // On confirmé le changement de valeur du champ opened dans la BDD

        $state =  $restaurant->opened == false ? 'Fermé' : 'Ouvert';

        return redirect()->back()->with('toast_success', 'Restaurant ' . $state);  // On reste sur la page où l'on a appuyé le bouton.
    }
}
