<?php

namespace Core;

use Dotenv\Dotenv;

class Application
{
    public function __construct()
    {
        $this->loadConfig();
        Database::connect();
        $this->registerRoutes();
    }

    private function loadConfig()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        foreach (glob(__DIR__ . '/../config/*.php') as $configFile) {
            require_once $configFile;
        }
    }

    private function registerRoutes()
    {
        $router = new Router();
        $GLOBALS['router'] = $router; // Make router global

        // Load routes from the routes directory
        foreach (glob(__DIR__ . '/../routes/*.php') as $routeFile) {
            require_once $routeFile;
        }
    }

    public function run()
    {
        $GLOBALS['router']->resolve();
    }
}
