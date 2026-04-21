<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Site;
use App\Models\Planning;
use App\Models\Presence;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

/**
 * Contrôleur du tableau de bord
 * Affiche les statistiques et informations selon le rôle de l'utilisateur
 */
class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord approprié selon le rôle de l'utilisateur
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupération de l'utilisateur connecté
        $user = auth()->user();
        // Date du jour
        $today = Carbon::today();

        /* ================= ADMIN ================= */
        // Si l'utilisateur est un administrateur
        if ($user->role === 'admin') {

            // Statistiques globales du système
            $agentsCount = Agent::count();      // Nombre total d'agents
            $sitesCount = Site::count();        // Nombre total de sites
            $planningsCount = Planning::count(); // Nombre total de plannings

            // Présences du jour
            $todayPresences = Presence::whereDate('date', $today)
                ->where('statut', 'present')
                ->count();

            $todayAbsences = Presence::whereDate('date', $today)
                ->where('statut', 'absent')
                ->count();

            // Données pour les graphiques (présences du jour)
            $present = Presence::whereDate('date', $today)
                ->where('statut', 'present')
                ->count();

            $retard = Presence::whereDate('date', $today)
                ->where('statut', 'retard')
                ->count();

            $absent = Presence::whereDate('date', $today)
                ->where('statut', 'absent')
                ->count();

            // Dernières présences enregistrées (5 dernières)
            $lastPresences = Presence::latest()->take(5)->get();

            // Transmission des données à la vue
            return view('dashboard.admin', compact(
                'agentsCount',
                'sitesCount',
                'planningsCount',
                'todayPresences',
                'todayAbsences',
                'present',
                'retard',
                'absent',
                'lastPresences'
            ));
        }

        /* ================= AGENT ================= */
        // Si l'utilisateur est un agent

        // Récupérer l'agent lié à l'utilisateur connecté
        $agent = $user->agent;

        // Vérifier le statut de présence du jour
        $todayPresence = Presence::where('agent_id', $agent->id)
            ->whereDate('date', $today)
            ->first();

        // Statistiques personnelles du mois en cours
        $month = Carbon::now()->month;

        // Nombre de présences ce mois
        $presentCount = Presence::where('agent_id', $agent->id)
            ->whereMonth('date', $month)
            ->where('statut', 'present')
            ->count();

        // Nombre d'absences ce mois
        $absentCount = Presence::where('agent_id', $agent->id)
            ->whereMonth('date', $month)
            ->where('statut', 'absent')
            ->count();

        // Nombre de retards ce mois
        $retardCount = Presence::where('agent_id', $agent->id)
            ->whereMonth('date', $month)
            ->where('statut', 'retard')
            ->count();

        // Prochain planning de l'agent (à partir d'aujourd'hui)
        $nextPlanning = Planning::where('agent_id', $agent->id)
            ->whereDate('date', '>=', $today)
            ->orderBy('date')
            ->first();

        // Historique récent des présences (5 dernières)
        $lastPresences = Presence::where('agent_id', $agent->id)
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();

        // Transmission des données à la vue agent
        return view('dashboard.agent', compact(
            'todayPresence',
            'presentCount',
            'absentCount',
            'retardCount',
            'nextPlanning',
            'lastPresences'
        ));
    }

    /**
     * Affiche l'historique des présences d'un agent
     * Route accessible uniquement par les agents
     *
     * @return \Illuminate\View\View
     */
    public function historiqueAgent()
    {
        // Récupération de l'utilisateur connecté
        $user = auth()->user();

        // Récupération des présences de l'agent connecté
        $presences = Presence::whereHas('agent', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('dashboard.historique-agent', compact('presences'));
    }
}

