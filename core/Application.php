<?php
namespace Core;

use Dotenv\Dotenv;
use App\Helper\Language;

class Application
{
    private $router;
    private $config = [];

    public function __construct()
    {
        Session::start();

        // Load configurations
        $this->loadConfig();

        // Handle language settings
        $this->handleLanguage();

        $this->initializeServices();
        $this->registerRoutes();
    }

    private function loadConfig()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        foreach (glob(__DIR__ . '/../config/*.php') as $configFile) {
            $this->config[basename($configFile, '.php')] = require $configFile;
        }
    }

    private function handleLanguage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lang'])) {
            $lang = $_POST['lang'];
            if (isset($this->config['language']) && in_array($lang, $this->config['language']['available'])) {
                Session::put('lang', $lang);
            }
        }

        // Set the default locale if not already set
        if (!Session::has('lang')) {
            Session::put('lang', $this->config['language']['default']);
        }

        // Load the translations
        $locale = Session::get('lang');
        $language = new Language($locale);
        $this->config['language']['current'] = $language;
    }

    private function registerRoutes()
    {
        $this->router = new Router();

        // Load routes from routes/web.php
        global $router; // global variable
        $router = $this->router;
        require_once __DIR__ . '/../routes/web.php';
    }

    private function initializeServices()
    {
        // Initialize other services if needed
    }

    public function run()
    {
        $this->router->resolve();
    }
}
