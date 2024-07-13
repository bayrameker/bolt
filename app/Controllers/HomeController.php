<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Response;
use Core\ViewRenderer;
use App\Services\HomeService;

class HomeController extends Controller
{
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index(Request $request, Response $response)
    {
        $homeData = $this->homeService->getHomeData();
        $viewRenderer = new ViewRenderer('home/index', [
            'title' => $homeData->title,
            'message' => $homeData->message,
            'layout' => 'layout'
        ]);
        $viewRenderer->render();
    }
}
