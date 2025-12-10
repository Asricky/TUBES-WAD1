<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Topic;

class DebugSeeder extends Seeder
{
    public function run(): void
    {
        echo "Debug: Creating one user...\n";
        try {
            User::factory()->create([
                'name' => 'Debug S',
                'email' => 'debugS'.time().'@test.com',
                'password' => Hash::make('password'),
            ]);
            echo "Debug: User created.\n";
        } catch (\Exception $e) {
            echo "Debug: User creation failed: " . $e->getMessage() . "\n";
        }

        echo "Debug: Creating Topic...\n";
        try {
            Topic::create([
                'name' => 'Debug Topic',
                'description' => 'Desc'
            ]);
            echo "Debug: Topic created.\n";
        } catch (\Exception $e) {
            echo "Debug: Topic creation failed: " . $e->getMessage() . "\n";
        }
    }
}
