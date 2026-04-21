<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Agent;
use App\Models\Planning;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Contrôleur pour la gestion des présences
 * Gère le pointage des agents et l'affichage des statistiques
 */
class PresenceController extends Controller
{
    /**
     * Affiche la page de pointage pour l'agent connecté
     * Vérifie si l'agent a un planning en cours
     *
     * @return \Illuminate\View\View
     */
    public function indexAgent()
    {
        // Récupère l'agent connecté
        $agent = auth()->user()->agent;
        // Récupère la date et heure actuelle
        $now = Carbon::now();

        // Récupère les plannings d'aujourd'hui et d'hier
        $plannings = Planning::where('agent_id', $agent->id)
            ->whereIn('date', [
                $now->toDateString(),
                $now->copy()->subDay()->toDateString(),
            ])
            ->get();

        // Récupère l'historique des présences (paginé)
        $presences = Presence::where('agent_id', $agent->id)
            ->orderBy('date', 'desc')
            ->paginate(5);

        // Transforme les présences pour ajouter les informations du planning
        $presences->getCollection()->transform(function ($presence) use ($agent) {
            // Récupère le planning correspondant à cette présence
            $planning = Planning::where('agent_id', $agent->id)
                ->where('date', '<=', $presence->date)
                ->orderBy('date', 'desc')
                ->first();

            return [
                'date' => $presence->date,
                'statut' => $presence->statut,
                'site_nom' => $planning?->site?->nom ?? '—',
                'heure_debut' => $planning?->heure_debut,
                'heure_fin' => $planning?->heure_fin,
            ];
        });

        $historique = $presences;
        $planningValide = null;
        $start = null;
        $end = null;

        // Vérifie si un planning est en cours
        foreach ($plannings as $planning) {
            // Construit les dates de début et fin du planning
            $s = Carbon::parse($planning->date . ' ' . $planning->heure_debut);
            $e = Carbon::parse($planning->date . ' ' . $planning->heure_fin);

            // Gère le cas où l'heure de fin est inférieure à l'heure de début (nuit)
            if ($planning->heure_fin < $planning->heure_debut) {
                $e->addDay();
            }

            // Vérifie si l'heure actuelle est dans la plage du planning
            if ($now->between($s, $e)) {
                $planningValide = $planning;
                $start = $s;
                $end = $e;
                break;
            }
        }

        // Si aucun planning en cours, affiche un message
        if (!$planningValide) {
            return view('agents.presence.index', [
                'available' => false,
                'message' => 'pas de pointage au moment.',
                'historique' => $historique
            ]);
        }

        // Vérifie si l'agent a déjà pointé aujourd'hui
        $presence = Presence::where('agent_id', $agent->id)
            ->whereDate('date', $start->toDateString())
            ->first();

        return view('agents.presence.index', [
            'available' => true,
            'planning' => $planningValide,
            'presence' => $presence,
            'start' => $start,
            'historique' => $historique
        ]);
    }

    /**
     * Enregistre le pointage de l'agent connecté
     * Détermine automatiquement le statut (présent ou retard)
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Récupère l'agent connecté avec le fuseau horaire du Maroc
        $agent = auth()->user()->agent;
        $now = Carbon::now('Africa/Casablanca');

        // Récupère tous les plannings de l'agent
        $plannings = Planning::where('agent_id', $agent->id)->get();

        foreach ($plannings as $planning) {
            // Construit les dates de début et fin
            $start = Carbon::parse($planning->date . ' ' . $planning->heure_debut);
            $end = Carbon::parse($planning->date . ' ' . $planning->heure_fin);

            // Gère le cas de nuit (heure de fin < heure de début)
            if ($planning->heure_fin < $planning->heure_debut) {
                $end->addDay();
            }

            // Si l'heure actuelle est dans la plage du planning
            if ($now->between($start, $end)) {
                // Vérifie si l'agent n'a pas déjà pointé aujourd'hui
                if (Presence::where('agent_id', $agent->id)
                    ->whereDate('date', $start->toDateString())
                    ->exists()) {
                    return back()->with('error', 'Pointage déjà effectué.');
                }

                // Détermine le statut : retard si plus de 15 minutes de retard
                $limit = $start->copy()->addMinutes(15);
                $statut = $now->greaterThan($limit) ? 'retard' : 'present';

                // Enregistre la présence
                Presence::create([
                    'agent_id' => $agent->id,
                    'date' => $start->toDateString(),
                    'statut' => $statut
                ]);

                return back()->with('success', "Pointage enregistré : $statut");
            }
        }

        return back()->with('error', 'Aucune affectation en cours.');
    }

    /* ================= PARTIE ADMIN ================= */

    /**
     * Affiche la liste des présences pour l'admin
     * Avec possibilité de filtrer par agent, site ou date
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function adminIndex(Request $request)
    {
        // Récupère les présences avec les relations agent et planning/site
        $presences = Presence::with([
                'agent',
                'agent.plannings.site'
            ])

            // Filtre par nom d'agent
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->whereHas('agent', function ($a) use ($request) {
                        $a->where('nom', 'LIKE', '%' . $request->search . '%');
                    })
                    ->orWhereHas('agent.plannings.site', function ($s) use ($request) {
                        $s->where('nom', 'LIKE', '%' . $request->search . '%');
                    });
                });
            })

            // Filtre par date
            ->when($request->date, function ($query) use ($request) {
                $query->whereDate('date', $request->date);
            })

            // Tri par date décroissante
            ->orderBy('date', 'desc')

            // Pagination
            ->paginate(5)
            ->withQueryString();

        return view('agents.presence.admin.index', compact('presences'));
    }

    /**
     * Met à jour le statut d'une présence (admin uniquement)
     *
     * @param Request $request
     * @param int $id ID de la présence à modifier
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validation du statut
        $request->validate([
            'statut' => 'required|in:present,absent,retard',
        ]);

        // Recherche et mise à jour de la présence
        $presence = Presence::findOrFail($id);
        $presence->update([
            'statut' => $request->statut,
        ]);

        return back()->with('success', 'Statut mis à jour');
    }
}

