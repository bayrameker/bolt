<?php

namespace Core;

class Router
{
    private $routes = [];

    public function get($uri, $callback)
    {
        $this->routes['GET'][$uri] = $callback;
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

        // Serve static files
        if ($this->isStaticFile($uri)) {
            $this->serveStaticFile($uri);
            return;
        }

        if (isset($this->routes[$method][$uri])) {
            call_user_func($this->routes[$method][$uri], new Request(), new Response());
        } else {
            header("HTTP/1.0 404 Not Found");
            echo "Not Found";
        }
    }

    private function getUri()
    {
        $uri = $_SERVER['REQUEST_URI'];

        if (strpos($uri, '?') !== false) {
            $uri = strstr($uri, '?', true);
        }

        $uri = rtrim($uri, '/');
        if (empty($uri)) {
            $uri = '/';
        }

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
