<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

try {
    echo "Creating User...\n";
    $user = User::factory()->create([
        'name' => 'Debug User',
        'email' => 'debug_' . time() . '@example.com',
        'password' => Hash::make('password'),
    ]);
    echo "User created successfully with role: " . $user->role . "\n";
} catch (\Exception $e) {
    echo "User creation failed: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
} catch (\Throwable $t) {
    echo "User creation failed (Throwable): " . $t->getMessage() . "\n";
    echo $t->getTraceAsString();
}
