<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Application;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$app = new Application();

$app->run();
//echo "Application loaded";
