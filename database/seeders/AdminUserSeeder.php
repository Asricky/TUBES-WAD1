<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create admin user if doesn't exist
        User::firstOrCreate(
            ['email' => 'admin@tell2u.com'],
            [
                'name' => 'Administrator',
                'email' => 'admin@tell2u.com',
                'password' => Hash::make('Admin123!'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@tell2u.com');
        $this->command->info('Password: Admin123!');
    }
}
