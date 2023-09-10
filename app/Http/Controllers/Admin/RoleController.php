<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::whereNotIn('name', ['admin'])->orderBy('name')->get(); //On récupère tous les rôles sauf le role 'admin'

        // dd($roles);
        // $roles = Role::all(); //On récupère tous les rôles
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // On vérifie si le nom du nouveau rôle à créer respecte nos règles de validation

        $request->validate(
            [
                'name' => 'required|min:2|unique:roles,name',
            ],
            [
                'name.required' => 'Le nom du rôle est requis',
                'name.min' => 'Le nom du rôle doit avoir au moins deux caractères',
                'name.unique' => 'Ce rôle existe déjà dans la base de données',
            ]
        );

        // On créer le nouveau rôle grâce à la fonction create d'éloquent.

        Role::create([
            'name' => $request->name,
        ]);

        // On fait une redirection vers l'index des rôles tout en affichant un message flash (toast) de la librairie  sweetalert.js
        return redirect()->route('admin.roles.index')->with('toast_success', 'Le nouveau rôle \' ' . $request->name . ' \' crée avec succès!');
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
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        // On vérifie la name respecte nos règles de validation

        $request->validate(
            [
                'name' => 'required|min:2|unique:roles,name,' . $role->id,
            ],
            [
                'name.required' => 'Le nom du rôle est requis',
                'name.min' => 'Le nom du rôle doit avoir au moins deux caractères',
            ]
        );


        $role->name = $request->name;

        $role->update();

        // On fait une redirection vers l'index des rôles tout en affichant un message flash (toast) de la librairie  sweetalert.js

        return redirect()->route('admin.roles.index')->with('toast_success', 'Le rôle  a été mis à jour!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // On fait attention à ne pas supprimer le rôle 'admin'

        if ($role->name == 'admin') {
            return redirect()->route('admin.roles.index')->with('toast_warning', 'Impossible de supprimer le rôle \'admin\'!');
        }

        $role->delete(); // On supprime le rôle

        // On fait une redirection vers l'index avec le message flash de succès (toast_success)

        return redirect()->route('admin.roles.index')->with('toast_success', 'Le rôle \' ' . $role->name . ' \' supprimé avec succès!');

    }
}
