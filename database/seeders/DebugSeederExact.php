<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
// Missing Hash import intentional to replicate DatabaseSeeder
// use Illuminate\Support\Facades\Hash;

class DebugSeederExact extends Seeder
{
    public function run(): void
    {
        // Replicating DatabaseSeeder exactly
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::factory()->create([
            'name' => 'Test Tubes',
            'email' => 'test@example.com', // Duplicate email
            'password' => Hash::make('test'),            
        ]);

        $this->call([
            TopicSeeder::class,
        ]);
    }
}
