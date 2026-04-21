<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Planning;
use App\Models\Site;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DemoPlanningsSeeder extends Seeder
{
    public function run(): void
    {
        $agents = Agent::with('user')->get();
        $sites = Site::all();

        foreach ($agents as $agent) {
            foreach ($sites as $site) {
                Planning::create([
                    'agent_id' => $agent->id,
                    'site_id' => $site->id,
                    'date' => Carbon::today()->addDays(rand(0, 30)),
                    'heure_debut' => '08:00',
                    'heure_fin' => '17:00',
                ]);
            }
        }
    }
}

