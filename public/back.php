<?php

require __DIR__.'/../vendor/autoload.php';

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
    // Fetch data from the database using the Test model
    $data = Test::all()->toArray();

    // Convert the data to JSON format
    $json = json_encode($data, JSON_PRETTY_PRINT);

    // Write JSON data to a file
    file_put_contents(__DIR__.'/data.json', $json);

} catch (\Exception $e) {
    // Handle exceptions
    echo "An error occurred: " . $e->getMessage();
}

// Terminate the request
$kernel->terminate($request, $response);
