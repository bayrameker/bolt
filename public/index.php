<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Ensure Composer autoload is included

require_once __DIR__ . '/../core/Session.php';
require_once __DIR__ . '/../app/Helper/functions.php'; // Ensure this path is correct

use Core\Application;

$app = new Application();
$app->run();
