<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\User;
use App\Models\Drink;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use App\Models\Restaurant;

class AdminController extends Controller
{
    public function index()
    {
        $menus = Menu::all()->count();  // On récupère le nombre de plats
        $drinks = Drink::all()->count(); // On récupère le nombre de boissons
        $users = User::all()->count(); // On récupère le nombre de compte d'utilisateurs
        $ingredients = Ingredient::all()->count(); // On récupère le nombre d'ingrédients en stock
        $opened =  Restaurant::all()[0]->opened;
        $orders = Order::all(); // On récupére le nombre de commandes effectuées

        $nbrOrders = $orders->count();



        $turnover = 0;
        $tax = 0;

        foreach ($orders as $order) {
            $turnover += $order->total;
            $tax += $order->tva;
        }



        return view('admin.index', compact('menus', 'drinks', 'users', 'opened', 'turnover', 'tax', 'ingredients', 'nbrOrders'));
    }

    /**
     *  Open/Close restaurant method
     */

    public function OpenCloseRestaurant()
    {
        $restaurant = Restaurant::all()[0];  // On récupère l'objet restaurant
        $restaurant->opened = !$restaurant->opened;  // On toggle la propriété opened (le champ opened dans la BDD)

        $restaurant->update();  // On confirmé le changement de valeur du champ opened dans la BDD

        return redirect()->back();  // On reste sur la page où l'on a appuyé le bouton. 
    }
}
