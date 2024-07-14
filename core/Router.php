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
        } catch (\Exception $e) {
            echo "Error registering route GET $uri: " . $e->getMessage() . "\n";
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

        if (isset($this->routes[$method][$uri])) {
            $callback = $this->routes[$method][$uri];

            if (is_array($callback)) {
                $controllerClass = $callback[0];
                $method = $callback[1];

                $controller = $this->getControllerInstance($controllerClass);

                try {
                    call_user_func([$controller, $method], new Request(), new Response());
                } catch (\Exception $e) {
                    echo "Error calling controller method: " . $e->getMessage() . "\n";
                }
            } else {
                try {
                    call_user_func($callback, new Request(), new Response());
                } catch (\Exception $e) {
                    echo "Error calling callback: " . $e->getMessage() . "\n";
                }
            }
        } else {
            header("HTTP/1.0 404 Not Found");
            echo "Not Found";
        }
    }

    private function getControllerInstance($controllerClass)
    {
        $reflectionClass = new \ReflectionClass($controllerClass);
        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            return new $controllerClass();
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependencyType = $parameter->getType();
            if ($dependencyType instanceof \ReflectionNamedType && !$dependencyType->isBuiltin()) {
                $dependencies[] = $this->resolveDependency($dependencyType->getName());
            }
        }

        return $reflectionClass->newInstanceArgs($dependencies);
    }

    private function resolveDependency($class)
    {
        $reflectionClass = new \ReflectionClass($class);
        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            return new $class();
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependencyType = $parameter->getType();
            if ($dependencyType instanceof \ReflectionNamedType && !$dependencyType->isBuiltin()) {
                $dependencies[] = $this->resolveDependency($dependencyType->getName());
            }
        }

        return $reflectionClass->newInstanceArgs($dependencies);
    }

    private function getUri()
    {
        $basePath = '/bolt';
        $uri = $_SERVER['REQUEST_URI'];

        if (strpos($uri, '?') !== false) {
            $uri = strstr($uri, '?', true);
        }

        if ($basePath && strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        $uri = trim($uri, '/');
        if (empty($uri)) {
            $uri = '/';
        } else {
            $uri = '/' . $uri;
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
