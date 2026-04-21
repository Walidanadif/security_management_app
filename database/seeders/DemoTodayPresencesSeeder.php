<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DemoTodayPresencesSeeder extends Seeder
{
    public function run(): void
    {
        $today = Carbon::today();
        $statuts = ['present', 'absent', 'retard'];

        Agent::chunk(50, function ($agents) use ($today, $statuts) {
            foreach ($agents as $agent) {
                // Créer une présence pour aujourd'hui
                Presence::updateOrCreate(
                    ['agent_id' => $agent->id, 'date' => $today],
                    [
                        'statut' => $statuts[array_rand($statuts)]
                    ]
                );
            }
        });
    }
}
