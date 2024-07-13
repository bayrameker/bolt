<?php

use App\Controllers\HomeController;
use App\Controllers\TestController;

global $router; // global değişkeni erişin

$router->get('/', [App\Controllers\HomeController::class, 'index']);

