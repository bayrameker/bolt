<?php

use App\Controllers\HomeController;
use App\Controllers\TestController;

global $router; // global değişkeni erişin

// Define routes
try {
    $router->get('/', [App\Controllers\HomeController::class, 'index']);
    $router->get('/test', [App\Controllers\TestController::class, 'index']);
    // echo "Routes defined successfully.\n";
} catch (\Exception $e) {
    //echo "Error defining routes: " . $e->getMessage() . "\n";
}
