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
                'telephone' => '0612345678',
                'adresse' => '12 Rue Sécurité, Paris',
            ],
            'fatima@test.com' => [
                'nom' => 'Fatima Zahra',
                'telephone' => '0698765432',
                'adresse' => '45 Av Protection, Lille',
            ],
            'mohamed@test.com' => [
                'nom' => 'Mohamed Ali',
                'telephone' => '0623456789',
                'adresse' => '78 Rue Vigilance, Marseille',
            ],
            'aisha@test.com' => [
                'nom' => 'Aisha Khalid',
                'telephone' => '0634567890',
                'adresse' => '23 Rue Patrouille, Lyon',
            ],
            'omar@test.com' => [
                'nom' => 'Omar Hassan',
                'telephone' => '0645678901',
                'adresse' => '56 Av Surveillance, Toulouse',
            ],
            'sara@test.com' => [
                'nom' => 'Sara Ben',
                'telephone' => '0656789012',
                'adresse' => '89 Rue Garde, Nice',
            ],
            'youssef@test.com' => [
                'nom' => 'Youssef El',
                'telephone' => '0667890123',
                'adresse' => '34 Rue Contrôle, Bordeaux',
            ],
            'leila@test.com' => [
                'nom' => 'Leila Amira',
                'telephone' => '0678901234',
                'adresse' => '67 Av Sécurité, Nantes',
            ],
            'karim@test.com' => [
                'nom' => 'Karim Said',
                'telephone' => '0689012345',
                'adresse' => '90 Rue Protection, Strasbourg',
            ],
            'nadia@test.com' => [
                'nom' => 'Nadia Rached',
                'telephone' => '0690123456',
                'adresse' => '12 Rue Alerte, Rennes',
            ],
            'hassan@test.com' => [
                'nom' => 'Hassan Morad',
                'telephone' => '0610123456',
                'adresse' => '45 Rue Veille, Montpellier',
            ],
            'mariam@test.com' => [
                'nom' => 'Mariam El',
                'telephone' => '0621234567',
                'adresse' => '78 Av Observatoire, Dijon',
            ],
            'rachid@test.com' => [
                'nom' => 'Rachid Ben',
                'telephone' => '0632345678',
                'adresse' => '23 Rue Sentinelle, Angers',
            ],
            'soumia@test.com' => [
                'nom' => 'Soumia Ali',
                'telephone' => '0643456789',
                'adresse' => '56 Rue Escorte, Le Havre',
            ],
            'walid@test.com' => [
                'nom' => 'Walid Karim',
                'telephone' => '0654567890',
                'adresse' => '89 Av Poste, Reims',
            ],
            'imane@test.com' => [
                'nom' => 'Imane Said',
                'telephone' => '0665678901',
                'adresse' => '34 Rue Service, Saint-Étienne',
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
