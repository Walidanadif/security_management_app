<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
$this->call([
            DemoUsersSeeder::class,
            DemoSitesSeeder::class,
            DemoAgentsSeeder::class,
            DemoPlanningsSeeder::class,
            DemoPresencesSeeder::class,
            DemoTodayPresencesSeeder::class,
        ]);
    }
}

