<?php

use App\Controllers\HomeController;

global $router; // global değişkeni erişin

// Define routes
$router->get('/', [HomeController::class, 'index']);
