<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Response;

class HomeController extends Controller
{
    public function __construct()
    {
       // echo "HomeController loaded\n";
    }

    public function registerRoutes($router)
    {
      //  echo "Registering route: GET /\n";
        $router->get('/', [$this, 'index']);
    }

    public function index(Request $request, Response $response)
    {
        //echo "Inside HomeController index method\n";
        $this->render('home', [
            'title' => 'Home Page',
            'message' => 'Welcome to My Bolt Framework!'
        ]);
    }
}
