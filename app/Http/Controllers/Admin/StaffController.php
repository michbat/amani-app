<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = Staff::orderBy('name', 'ASC')->paginate(5);

        return view('admin.staffs.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.staffs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // On contrôle si nos règles de validation ont été respectées

        $request->validate(
            [
                'name' => 'required',
                'image' => 'required|image|mimes:png,jpg,jpeg',
                'fonction' => 'required',
            ],
            [
                'name.required' => 'Le nom et le prénom sont requis',
                'image.required' => 'La photo du membre est requise',
                'image.image' => 'Le fichier doit être une image',
                'image.mimes' => 'Seuls les formats png,jpg,jpeg sont acceptés',
                'fonction.required' => 'Vous devez indiquer la fonction du membre'
            ]
        );

        $image = $request->file('image');  // On récupère le fichier image
        $path = '/uploads/staff/';  // On définit le répertoire vers lequel on va stocker l'image

        $staff = new Staff();

        $staff->restaurant_id = Restaurant::where('name', 'Amani')->first()->id;
        $staff->name = $request->name;
        $staff->fonction = $request->fonction;
        $staff->image = uploadImage($image, $path);

        $staff->save();

        return redirect()->route('admin.staffs.index')->with('toast_success', 'Le nouveau membre du personnel a été ajouté avec succès');
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
    public function edit(Staff $staff)
    {
        return view('admin.staffs.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $request->validate(
            [
                'name' => 'required',
                'fonction' => 'required',

            ],
            [
                'name.required' => 'Le nom et le prénom sont requis',
                'fonction.required' => 'Vous devez indiquer la fonction du membre',
            ]
        );

        // On checke si une image a été chargée

        $charged = $request->hasFile('image');
        $image = "";

        if ($charged) {
            $request->validate(
                [
                    'image' => 'image|mimes:png,jpg,jpeg',
                ],
                [
                    'image.image' => 'Le fichier doit être une image',
                    'image.mimes' => 'Seuls les formats png,jpg,jpeg sont acceptés',
                ]
            );
            $image = $request->file('image'); // On récupère l'image dans une variable $image
            $path = '/uploads/staff/';
            $old_path = public_path($staff->image); // On récupère le chemin vers le dossier où l'image est stockée

        }

        $staff->restaurant_id = Restaurant::where('name', 'Amani')->first()->id;
        $staff->name = $request->name;
        $staff->fonction = $request->fonction;
        $staff->image = $charged ? uploadImage($image, $path, $old_path) : $staff->image;

        $staff->update();

        return redirect()->route('admin.staffs.index')->with('toast_success', 'Le membre du personnel a été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        if (file_exists(public_path($staff->image))) {
            unlink(public_path($staff->image));
        }

        $staff->delete();

        return redirect()->route('admin.staffs.index')->with('toast_success', 'Le membre du personnel a été supprimé de la galerie');
    }
}
