<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create standard user if doesn't exist
        User::firstOrCreate(
            ['email' => 'user@tell2u.com'],
            [
                'name' => 'Mahasiswa User',
                'email' => 'user@tell2u.com',
                'password' => Hash::make('User123!'),
                'role' => 'pelanggan',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Standard user created successfully!');
        $this->command->info('Email: user@tell2u.com');
        $this->command->info('Password: User123!');
    }
}
