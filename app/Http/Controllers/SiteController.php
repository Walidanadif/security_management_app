<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;

/**
 * Contrôleur pour la gestion des sites
 * Gère les opérations CRUD sur les sites
 */
class SiteController extends Controller
{
    /**
     * Affiche la liste des sites avec possibilité de recherche
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Récupère les sites avec pagination et filtre de recherche
        $sites = Site::query()
            ->when($request->search, function ($query) use ($request) {
                // Filtre par nom si une recherche est effectuée
                $query->where('nom', 'LIKE', '%' . $request->search . '%');
            })
            ->paginate(5)
            ->withQueryString();

        return view('sites.index', compact('sites'));
    }

    /**
     * Affiche le formulaire de création d'un site
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('sites.create');
    }

    /**
     * Enregistre un nouveau site dans la base de données
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'nom' => 'required',
            'adresse' => 'required',
        ]);

        // Création du site
        Site::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
        ]);

        return redirect('/sites');
    }

    /**
     * Supprime un site
     *
     * @param int $id ID du site à supprimer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Recherche et suppression du site
        $site = Site::findOrFail($id);
        $site->delete();

        return redirect('/sites');
    }

    /**
     * Affiche le formulaire d'édition d'un site
     *
     * @param int $id ID du site à modifier
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Récupère le site à modifier
        $site = Site::findOrFail($id);
        return view('sites.edit', compact('site'));
    }

    /**
     * Met à jour les informations d'un site
     *
     * @param Request $request
     * @param int $id ID du site à modifier
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required',
            'adresse' => 'required',
        ]);

        // Recherche et mise à jour du site
        $site = Site::findOrFail($id);
        $site->nom = $request->nom;
        $site->adresse = $request->adresse;
        $site->save();

        return redirect('/sites')->with('success', 'Site mis à jour avec succès');
    }
}

