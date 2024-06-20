<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Response;
use Core\ViewRenderer;

class HomeController extends Controller
{
    public function registerRoutes($router)
    {
        $router->get('/', [$this, 'index']);
    }

    public function index(Request $request, Response $response)
    {
        $viewRenderer = new ViewRenderer('home', [
            'title' => 'Home Page',
            'message' => 'Welcome to My Bolt Framework!',
            'layout' => 'layout'
        ]);
        $viewRenderer->render();
    }
}
