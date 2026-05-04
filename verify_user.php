<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "User Count: " . User::count() . PHP_EOL;

$user = User::where('email', 'test@example.com')->first();
if ($user) {
    echo "Found: {$user->email}" . PHP_EOL;
    echo "Hash: {$user->password}" . PHP_EOL;
    echo "Check '12345678': " . (Hash::check('12345678', $user->password) ? 'OK' : 'FAIL') . PHP_EOL;
} else {
    echo "Test user NOT found!" . PHP_EOL;
}
