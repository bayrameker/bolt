<?php

namespace Core;

use Dotenv\Dotenv;
use Core\AI\AIManager;

class Application
{
    public $aiManager;
    private $router;

    public function __construct()
    {
        $this->loadConfig();
        $this->initializeServices();
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
        $this->router = new Router();

        // Load routes from routes/web.php
        global $router; // global değişkeni tanımlayın
        $router = $this->router;
        require_once __DIR__ . '/../routes/web.php';
    }

    private function initializeServices()
    {
        try {
            $this->aiManager = new AIManager();
        } catch (\Exception $e) {
            // AIManager yapılandırılamazsa, hatayı loglayın ve devam edin
            error_log($e->getMessage());
        }
    }

    public function run()
    {
        $this->router->resolve();
    }
}
