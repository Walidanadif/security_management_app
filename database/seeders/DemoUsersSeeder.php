
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@security-app.com'],
            [
                'name' => 'Admin Security',
                'email' => 'admin@security-app.com',
                'password' => Hash::make('test@1234'),
                'role' => 'admin',
            ]
        );

        // Agents
        User::updateOrCreate(
            ['email' => 'ahmed@test.com'],
            [
                'name' => 'Ahmed Benali',
                'email' => 'ahmed@test.com',
                'password' => Hash::make('test@1234'),
                'role' => 'agent',
            ]
        );

        User::updateOrCreate(
            ['email' => 'fatima@test.com'],
            [
                'name' => 'Fatima Zahra',
                'email' => 'fatima@test.com',
                'password' => Hash::make('test@1234'),
                'role' => 'agent',
            ]
        );
    }
}

