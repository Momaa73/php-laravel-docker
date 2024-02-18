<?php

require __DIR__.'/../vendor/autoload.php';

use App\Coffee; // Import the Coffee model

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
    // Example: Fetch and display data from the database using the Coffee model
    $data = Coffee::all();

    // Iterate through the collection and display the data
    echo "<h2>Data from Coffee Table:</h2>";
    foreach ($data as $coffee) {
        echo "Coffee: " . $coffee->name . " | Price: " . $coffee->price . "<br>";
    }

} catch (\Exception $e) {
    // Handle exceptions
    echo "An error occurred: " . $e->getMessage();
}

// Terminate the request
$kernel->terminate($request, $response);
