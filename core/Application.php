<?php

namespace Core;

use Dotenv\Dotenv;
use Core\AI\AIManager;

class Application
{
    public $aiManager;

    public function __construct()
    {
        $this->loadConfig();
        $this->registerRoutes();
        Database::connect();
        $this->initializeServices();
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

        // Dynamically load routes from controllers
        foreach (glob(__DIR__ . '/../app/Controllers/*.php') as $controllerFile) {
            require_once $controllerFile;
            $class = 'App\\Controllers\\' . basename($controllerFile, '.php');
            if (class_exists($class) && method_exists($class, 'registerRoutes')) {
                $controller = new $class();
                $controller->registerRoutes($router);
            }
        }

        $GLOBALS['router'] = $router;
    }

    private function initializeServices()
    {
        $this->aiManager = new AIManager();
    }

    public function run()
    {
        $GLOBALS['router']->resolve();
    }
}
