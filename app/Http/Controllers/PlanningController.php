<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planning;
use App\Models\Agent;
use App\Models\Site;

/**
 * Contrôleur pour la gestion des plannings
 * Gère les opérations CRUD sur les plannings des agents
 */
class PlanningController extends Controller
{
    /**
     * Affiche la liste des plannings avec possibilité de filtrage
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Récupère les plannings avec leurs relations (agent et site)
        $plannings = Planning::with(['agent', 'site'])

            // Filtre par nom d'agent ou de site
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->whereHas('agent', function ($a) use ($request) {
                        $a->where('nom', 'LIKE', '%' . $request->search . '%');
                    })
                    ->orWhereHas('site', function ($s) use ($request) {
                        $s->where('nom', 'LIKE', '%' . $request->search . '%');
                    });
                });
            })

            // Filtre par date spécifique
            ->when($request->date, function ($query) use ($request) {
                $query->whereDate('date', $request->date);
            })

            // Tri par date décroissante (les plus récents en premier)
            ->orderBy('date', 'desc')

            // Pagination avec conservation des paramètres de recherche
            ->paginate(5)
            ->withQueryString();

        return view('plannings.index', compact('plannings'));
    }

    /**
     * Affiche le formulaire de création d'un planning
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Récupère la liste des agents et sites pour les listes déroulantes
        $agents = Agent::select('id', 'nom')->get();
        $sites = Site::select('id', 'nom')->get();

        return view('plannings.create', compact('agents', 'sites'));
    }

    /**
     * Enregistre un nouveau planning dans la base de données
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'site_id' => 'required|exists:sites,id',
            'date' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
        ]);

        // Création du planning
        Planning::create($request->all());

        return redirect('/plannings');
    }

    /**
     * Supprime un planning
     *
     * @param int $id ID du planning à supprimer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Recherche et suppression du planning
        $planning = Planning::findOrFail($id);
        $planning->delete();

        return redirect('/plannings');
    }

    /**
     * Affiche le formulaire d'édition d'un planning
     *
     * @param int $id ID du planning à modifier
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Récupère le planning à modifier
        $planning = Planning::findOrFail($id);
        // Récupère la liste des agents et sites
        $agents = Agent::select('id', 'nom')->get();
        $sites = Site::select('id', 'nom')->get();

        return view('plannings.edit', compact('planning', 'agents', 'sites'));
    }

    /**
     * Met à jour un planning existant
     *
     * @param Request $request
     * @param int $id ID du planning à modifier
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'site_id' => 'required|exists:sites,id',
            'date' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
        ]);

        // Recherche et mise à jour du planning
        $planning = Planning::findOrFail($id);
        $planning->update($request->all());

        return redirect('/plannings');
    }

    /**
     * Affiche le calendrier des plannings de l'agent connecté
     *
     * @return \Illuminate\View\View
     */
    public function index2()
    {
        return view('agents.calendrier');
    }

    /**
     * Récupère les événements du calendrier pour l'agent connecté
     * Retourne les données au format JSON pour FullCalendar
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function events()
    {
        // Récupère l'agent de l'utilisateur connecté
        $agent = auth()->user()->agent;

        // Si pas d'agent, retourne un tableau vide
        if (!$agent) {
            return response()->json([]);
        }

        // Récupère les plannings de l'agent avec le site associé
        $plannings = Planning::with('site')
            ->where('agent_id', $agent->id)
            ->get();

        // Transforme les plannings en événements pour FullCalendar
        $events = $plannings->map(function ($p) {
            return [
                'title' => $p->site->nom, // Nom du site comme titre
                'start' => $p->date . 'T' . $p->heure_debut, // Date et heure de début
                'end' => $p->date . 'T' . $p->heure_fin, // Date et heure de fin
                'extendedProps' => [
                    'adresse' => $p->site->adresse, // Adresse du site
                ],
            ];
        });

        return response()->json($events);
    }
}

