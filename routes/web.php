<?php

use Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AboutController;

// Initialize the Router
$router = $GLOBALS['router'];

// Define routes
$router->get('/', [HomeController::class, 'index']);
$router->get('about', [AboutController::class, 'index']);
