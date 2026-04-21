<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Contrôleur pour la gestion du profil utilisateur
 * Permet à l'utilisateur de modifier ses informations personnelles
 */
class ProfileController extends Controller
{
    /**
     * Affiche le formulaire d'édition du profil
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        // Récupère l'utilisateur actuellement connecté
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Met à jour les informations du profil
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Récupère l'utilisateur connecté
        $user = Auth::user();

        // Validation des données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Mise à jour du nom et de l'email
        $user->name = $request->name;
        $user->email = $request->email;

        // Mise à jour du mot de passe si fourni
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Sauvegarde les modifications
        $user->save();

        // Redirection avec message de succès
        return redirect()->back()->with('success', 'Profil mis à jour');
    }
}

