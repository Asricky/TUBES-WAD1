<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Topic;

try {
    echo "Creating Topic...\n";
    Topic::create([
        'name' => 'Debug Topic',
        'description' => 'Test Description'
    ]);
    echo "Topic created successfully.\n";
} catch (\Exception $e) {
    echo "Topic creation failed: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
