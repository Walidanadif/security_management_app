<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoPresencesSeeder extends Seeder
{
    public function run(): void
    {
        $agents = Agent::all();
        $statuts = ['présent', 'absent', 'retard', 'congé'];

        foreach ($agents as $agent) {
            for ($i = 0; $i < 10; $i++) {
                Presence::create([
                    'agent_id' => $agent->id,
                    'date' => Carbon::today()->subDays(rand(1, 30)),
                    'statut' => $statuts[array_rand($statuts)],
                    'heure_arrivee' => rand(7, 10) . ':00',
                    'heure_depart' => rand(16, 19) . ':00',
'commentaire' => 'Pointage automatique ' . rand(1,100),
                ]);
            }
        }
    }
}

