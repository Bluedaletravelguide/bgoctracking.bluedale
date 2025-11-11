<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class InitialUsersSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            ['name' => 'superadmin',   'email' => 'superadmin@bluedale.com.my',   'username' => 'admin1',   'role' => 'superadmin'],
            ['name' => 'admin',   'email' => 'admin@bluedale.com.my',   'username' => 'admin',   'role' => 'admin'],
            ['name' => 'support',    'email' => 'support@bluedale.com.my',    'username' => 'support',    'role' => 'support'],
            ['name' => 'sales',    'email' => 'sales@bluedale.com.my',    'username' => 'sales',    'role' => 'sales'],
            ['name' => 'services', 'email' => 'services@bluedale.com.my', 'username' => 'services', 'role' => 'services'],
        ];

        foreach ($accounts as $acct) {
            $user = User::updateOrCreate(
                ['email' => $acct['email']],
                [
                    'name'     => $acct['name'],
                    'email'    => $acct['email'],
                    'username' => $acct['username'],
                    'password' => Hash::make($acct['username']),
                    'email_verified_at' => now(),
                ]
            );

            // Assign role using Spatie
            $user->syncRoles([$acct['role']]);
        }
    }
}
