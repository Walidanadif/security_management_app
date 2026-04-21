<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Planning;
use App\Models\Presence;
use Carbon\Carbon;

class CheckAbsences extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-absences';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
public function handle()
{
    $now = Carbon::now('Africa/Casablanca');

    $plannings = Planning::whereDate('date', '<=', $now->toDateString())->get();

    foreach ($plannings as $planning) {

        $start = Carbon::parse($planning->date.' '.$planning->heure_debut);
        $end   = Carbon::parse($planning->date.' '.$planning->heure_fin);

        if ($planning->heure_fin < $planning->heure_debut) {
            $end->addDay();
        }

        if ($now->greaterThan($end)) {

            $absenceDate = $end->toDateString(); 

            $presence = Presence::where('agent_id', $planning->agent_id)
                ->whereDate('date', $absenceDate)
                ->first();

            if (!$presence || $presence->statut !== 'present') {
                Presence::updateOrCreate(
                    [
                        'agent_id' => $planning->agent_id,
                        'date'     => $absenceDate,
                    ],
                    [
                        'statut' => 'absent',
                    ]
                );
            }
        }
    }
}

}
