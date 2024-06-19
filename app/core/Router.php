<?php

namespace App\Core;

class Router
{
    private $routes = [];

    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function dispatch($uri)
    {
        $uri = parse_url($uri, PHP_URL_PATH);

        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $path => $callback) {
            $pathPattern = preg_replace('/\{([a-z]+)\}/', '([a-zA-Z0-9_\-]+)', $path);
            if (preg_match("#^$pathPattern$#", $uri, $matches)) {
                array_shift($matches);
                list($controller, $method) = explode('@', $callback);
                $controller = "App\\Controllers\\$controller";
                call_user_func_array([new $controller, $method], $matches);
                return;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
