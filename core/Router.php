<?php

namespace Core;

class Router
{
    private $routes = [];

    public function get($uri, $callback)
    {
        $this->routes['GET'][$uri] = $callback;
       // echo "Route registered: GET $uri\n";
    }

    public function post($uri, $callback)
    {
        $this->routes['POST'][$uri] = $callback;
        //echo "Route registered: POST $uri\n";
    }

    public function resolve()
    {
        $uri = $this->getUri();
        $method = $_SERVER['REQUEST_METHOD'];

        //echo "Resolving route: $method $uri\n";

        if (isset($this->routes[$method][$uri])) {
            //echo "Route found\n";
            call_user_func($this->routes[$method][$uri], new Request(), new Response());
        } else {
            //echo "404 Not Found";
        }
    }

    private function getUri()
    {
        $uri = $_SERVER['REQUEST_URI'];
       // echo "Raw URI: $uri\n";
        
        if (strpos($uri, '?') !== false) {
            $uri = strstr($uri, '?', true);
        }
        
        $uri = rtrim($uri, '/');
        if (empty($uri)) {
            $uri = '/';
        }
        
       // echo "Processed URI: $uri\n";
        return $uri;
    }
}
