<?php

namespace App\Http\Controllers\Personnel;

use App\Models\Restaurant;
use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantEditRequest;

class RestaurantPersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurant = Restaurant::where('name', 'Amani')->first();
        return view('personnel.restaurants.index', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        return view('personnel.restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RestaurantEditRequest $request, Restaurant $restaurant)
    {
        // dd($request->all());
        $request->validated();

        $restaurant->name = $request->name;
        $restaurant->phone = $request->phone;
        $restaurant->gsm = $request->gsm;
        $restaurant->email = $request->email;
        $restaurant->roadName = $request->roadName;
        $restaurant->number = $request->number;
        $restaurant->postalCode = $request->postalCode;
        $restaurant->city = $request->city;
        $restaurant->facebookLink = $request->facebookLink;
        $restaurant->twitterLink = $request->twitterLink;
        $restaurant->instagramLink = $request->instagramLink;
        $restaurant->aboutUs = $request->aboutUs;
        $restaurant->reglement = $request->reglement;
        $restaurant->opened = $request->opened;

        $restaurant->update();

        return redirect()->route('personnel.restaurants.index')->with('toast_success', 'Les informations du restaurant ont été mises à jour');
    }
}
