<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Restaurant;
use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantEditRequest;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurant = Restaurant::where('name', 'Amani')->first();
        return view('admin.restaurants.index', compact('restaurant'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        $tags = Tag::all();
        return view('admin.restaurants.show', compact('restaurant','tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        return view('admin.restaurants.edit', compact('restaurant'));
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

        $restaurant->update();

        return redirect()->route('admin.restaurants.index')->with('toast_success', 'Les informations du restaurant ont été mises à jour');

    }

}
