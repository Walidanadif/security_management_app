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

        // Agents (15+)
        $agentNames = [
            'Ahmed Benali', 'Fatima Zahra', 'Mohamed Ali', 'Aisha Khalid', 'Omar Hassan',
            'Sara Ben', 'Youssef El', 'Leila Amira', 'Karim Said', 'Nadia Rached',
            'Hassan Morad', 'Mariam El', 'Rachid Ben', 'Soumia Ali', 'Walid Karim', 'Imane Said',
        ];

        $agentEmails = [
            'ahmed@test.com', 'fatima@test.com', 'mohamed@test.com', 'aisha@test.com', 'omar@test.com',
            'sara@test.com', 'youssef@test.com', 'leila@test.com', 'karim@test.com', 'nadia@test.com',
            'hassan@test.com', 'mariam@test.com', 'rachid@test.com', 'soumia@test.com', 'walid@test.com', 'imane@test.com',
        ];

        foreach ($agentEmails as $email) {
            $index = array_search($email, $agentEmails);
            $name = $agentNames[$index];
            
            User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make('test@1234'),
                    'role' => 'agent',
                ]
            );
        }
    }
}
