<?php

require __DIR__.'/../vendor/autoload.php';

use App\Coffee;
use App\Test;

// Laravel application
$app = require_once __DIR__.'/../bootstrap/app.php';

// Illuminate HTTP Kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Handle the incoming request
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// Display errors in development mode
if (config('app.env') === 'local') {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}

// Your custom code
try {
    // Fetch data from the "coffee" table using the Coffee model
    $coffees = Coffee::all();

    // Fetch data from the "test" table using the Test model
    $tests = Test::all();

    // Display data from both models
    echo "<h2>Data from Coffee Table:</h2>";
    foreach ($coffees as $coffee) {
        echo "Coffee: " . $coffee->name . " | Price: " . $coffee->price . "<br>";
    }

    echo "<h2>Data from Test Table:</h2>";
    foreach ($tests as $test) {
        echo "ID: " . $test->id . " | Name: " . $test->name . "<br>";
    }

} catch (\Exception $e) {
    // Handle exceptions
    echo "An error occurred: " . $e->getMessage();
}

// Terminate the request
$kernel->terminate($request, $response);
