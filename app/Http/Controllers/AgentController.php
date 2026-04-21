<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Contrôleur pour la gestion des agents
 * Gère les opérations CRUD sur les agents
 */
class AgentController extends Controller
{
    /**
     * Affiche la liste des agents avec possibilité de recherche
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Récupère les agents avec pagination et filtre de recherche
        $agents = Agent::query()
            ->when($request->search, function ($query) use ($request) {
                // Filtre par nom si une recherche est effectuée
                $query->where('nom', 'LIKE', '%' . $request->search . '%');
            })
            ->paginate(5)
            ->withQueryString();

        return view('agents.index', compact('agents'));
    }

    /**
     * Affiche le formulaire de création d'un agent
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('agents.create');
    }

    /**
     * Enregistre un nouvel agent dans la base de données
     * Crée également un compte utilisateur associé
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'nom' => 'required',
            'email' => 'required',
            'password' => 'required',
            'telephone' => 'required',
            'adresse' => 'required',
        ]);

        // Création de l'utilisateur avec le rôle 'agent'
        User::create([
            'name' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'agent',
        ]);

        // Récupération de l'utilisateur créé
        $user = User::where('email', $request->email)->first();

        // Création de l'agent associé à l'utilisateur
        Agent::create([
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'user_id' => $user->id,
        ]);

        return redirect('/agents');
    }

    /**
     * Supprime un agent et son compte utilisateur associé
     *
     * @param int $id ID de l'agent à supprimer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Recherche de l'agent
        $agent = Agent::findOrFail($id);

        // Récupération de l'ID utilisateur avant suppression
        $userId = $agent->user_id;

        // Suppression de l'agent
        $agent->delete();

        // Suppression du compte utilisateur associé
        User::where('id', $userId)->delete();

        return redirect('/agents')->with('success', 'Agent supprimé avec succès');
    }

    /**
     * Affiche le formulaire d'édition d'un agent
     *
     * @param int $id ID de l'agent à modifier
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $agent = Agent::findOrFail($id);
        return view('agents.edit', compact('agent'));
    }

    /**
     * Met à jour les informations d'un agent
     *
     * @param Request $request
     * @param int $id ID de l'agent à modifier
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required',
            'telephone' => 'required',
            'adresse' => 'required',
        ]);

        $agent = Agent::findOrFail($id);
        $agent->update([
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
        ]);

        return redirect('/agents');
    }
}
