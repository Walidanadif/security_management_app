<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoAgentsSeeder extends Seeder
{
    public function run(): void
    {
        $agents = [
            'ahmed@test.com' => [
                'nom' => 'Ahmed Benali',
                'tel' => '0612345678',
                'adresse' => '12 Rue Sécurité, Paris',
            ],
            'fatima@test.com' => [
                'nom' => 'Fatima Zahra',
                'tel' => '0698765432',
                'adresse' => '45 Av Protection, Lille',
            ],
        ];

        foreach ($agents as $email => $data) {
            $user = User::where('email', $email)->first();
            if ($user) {
                Agent::updateOrCreate(
                    ['user_id' => $user->id],
                    $data
                );
            }
        }
    }
}

