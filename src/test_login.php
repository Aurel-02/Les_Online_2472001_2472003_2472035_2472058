<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$plain = 'password123';
$hash1 = Illuminate\Support\Facades\Hash::make($plain);

$user = new App\Models\User();
$user->password = $hash1;

echo "Original Hash: " . $hash1 . "\n";
echo "Model Hash   : " . $user->password . "\n";

echo "Check plain vs Original Hash: " . (Illuminate\Support\Facades\Hash::check($plain, $hash1) ? "TRUE" : "FALSE") . "\n";
echo "Check plain vs Model Hash   : " . (Illuminate\Support\Facades\Hash::check($plain, $user->password) ? "TRUE" : "FALSE") . "\n";
