<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::where('email', 'test@example.com')->first();

if ($user) {
    echo "Email: " . $user->email . PHP_EOL;
    echo "Password hash: " . $user->password . PHP_EOL;
    echo "Check '12345678': " . (Hash::check('12345678', $user->password) ? 'MATCH' : 'NO MATCH') . PHP_EOL;
    echo "Check 'password123': " . (Hash::check('password123', $user->password) ? 'MATCH' : 'NO MATCH') . PHP_EOL;
} else {
    echo "User not found!" . PHP_EOL;
}
