
<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Seeder;

class DemoSitesSeeder extends Seeder
{
    public function run(): void
    {
        $sites = [
            [
                'nom' => 'Site Central',
                'adresse' => '123 Rue de la Sécurité, Paris',
            ],
            [
                'nom' => 'Site Nord',
                'adresse' => '456 Avenue Protection, Lille',
            ],
            [
                'nom' => 'Site Sud',
                'adresse' => '789 Boulevard Garde, Marseille',
            ],
        ];

        foreach ($sites as $site) {
            Site::updateOrCreate(['nom' => $site['nom']], $site);
        }
    }
}

