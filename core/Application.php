<?php

namespace Core;

class Application
{
    public function __construct()
    {
        $this->loadConfig();
        $this->registerRoutes();
        Database::connect();
    }

    private function loadConfig()
    {
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
               // echo "Registering routes for: " . $class . "\n";
                $controller->registerRoutes($router);
            }
        }

        $GLOBALS['router'] = $router;
    }

    public function run()
    {
        //echo "Running router\n";
        $GLOBALS['router']->resolve();
    }
}
