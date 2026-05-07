<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$dbHash = '$2y$12$1SQ.sDzK/NLFAr3MHGIfqeH4tt.zLMExpuWpOTRGl6ll.5f7ESkgO';
echo "Check 'siswa': " . (Illuminate\Support\Facades\Hash::check('siswa', $dbHash) ? "TRUE" : "FALSE") . "\n";
echo "Check 'password': " . (Illuminate\Support\Facades\Hash::check('password', $dbHash) ? "TRUE" : "FALSE") . "\n";
echo "Check '12345678': " . (Illuminate\Support\Facades\Hash::check('12345678', $dbHash) ? "TRUE" : "FALSE") . "\n";
