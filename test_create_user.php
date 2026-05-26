<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $user = App\Models\User::create([
        'nama' => 'Test', 
        'email' => 'test@test.com', 
        'password' => 'testtest', 
        'role' => 'siswa'
    ]);
    echo "Success!";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
