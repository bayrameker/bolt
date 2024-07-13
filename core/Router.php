<?php

namespace Core;

class Router
{
    private $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => [],
    ];

    public function get($uri, $callback)
    {
        try {
            if (empty($uri)) {
                throw new \Exception("URI cannot be empty");
            }

            if (!is_array($callback) || count($callback) !== 2) {
                throw new \Exception("Callback must be an array with controller class and method");
            }

            list($controller, $method) = $callback;

            if (!class_exists($controller)) {
                throw new \Exception("Controller class $controller does not exist");
            }

            if (!method_exists($controller, $method)) {
                throw new \Exception("Method $method does not exist in controller class $controller");
            }

            $this->routes['GET'][$uri] = $callback;
            // echo "Route GET $uri registered successfully with controller $controller and method $method.\n";
        } catch (\Exception $e) {
            // echo "Error registering route GET $uri: " . $e->getMessage() . "\n";
        }
    }

    public function post($uri, $callback)
    {
        $this->routes['POST'][$uri] = $callback;
    }

    public function put($uri, $callback)
    {
        $this->routes['PUT'][$uri] = $callback;
    }

    public function delete($uri, $callback)
    {
        $this->routes['DELETE'][$uri] = $callback;
    }

    public function resolve()
    {
        $uri = $this->getUri();
        $method = $_SERVER['REQUEST_METHOD'];

        //echo "Resolving route for URI: '$uri' with method: $method\n";

        // Mevcut rotaları yazdır
        // echo "Available routes for method $method:\n";
        foreach ($this->routes[$method] as $route => $callback) {
            // echo "  $route\n";
        }

        if (isset($this->routes[$method][$uri])) {
            $callback = $this->routes[$method][$uri];
            //echo "Matched route: $uri\n";
            //echo "Callback: " . print_r($callback, true) . "\n";

            if (is_array($callback)) {
                $controller = new $callback[0]();
                $method = $callback[1];

                try {
                   // echo "Calling controller method: " . get_class($controller) . "::" . $method . "\n";
                    call_user_func([$controller, $method], new Request(), new Response());
                } catch (\Exception $e) {
                    // echo "Error calling controller method: " . $e->getMessage() . "\n";
                }
            } else {
                try {
                    //echo "Calling callback\n";
                    call_user_func($callback, new Request(), new Response());
                } catch (\Exception $e) {
                    //echo "Error calling callback: " . $e->getMessage() . "\n";
                }
            }
        } else {
            // echo "Route not found for URI: '$uri' with method: $method\n";
            //echo "Defined routes:\n" . print_r($this->routes, true) . "\n";
            header("HTTP/1.0 404 Not Found");
            echo "Not Found";
        }
    }

    private function getUri()
    {
        $basePath = '/bolt'; // Projenizin alt dizin yolu
        $uri = $_SERVER['REQUEST_URI'];
        // echo "Original URI: $uri\n";

        if (strpos($uri, '?') !== false) {
            $uri = strstr($uri, '?', true);
        }

        // basePath'i URI'den çıkar
        if ($basePath && strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        $uri = trim($uri, '/');
        if (empty($uri)) {
            $uri = '/';
        } else {
            $uri = '/' . $uri; // Başına slash ekle
        }

        //echo "Processed URI after basePath removal: $uri\n";

        return $uri;
    }

    private function isStaticFile($uri)
    {
        $filePath = __DIR__ . '/../public' . $uri;
        return file_exists($filePath) && !is_dir($filePath);
    }

    private function serveStaticFile($uri)
    {
        $filePath = __DIR__ . '/../public' . $uri;
        $mimeType = mime_content_type($filePath);
        header('Content-Type: ' . $mimeType);
        readfile($filePath);
    }
}
