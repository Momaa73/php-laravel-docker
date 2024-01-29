<?php

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

echo "MORANNNN"; // Existing line

// Fetch all rows from the "test" table
$testData = \App\Test::all();

// Output the data (just for testing purposes)
foreach ($testData as $row) {
    echo "ID: " . $row->id . ", Name: " . $row->name . "<br>";
}

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
