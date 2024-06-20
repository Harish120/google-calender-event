<?php

namespace App\Core;

class Router
{
    private $routes = [];

    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function dispatch($uri, $requestMethod)
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $method = strtoupper($requestMethod);

        foreach ($this->routes[$method] as $route => $callback) {
            $routePattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $route);
            if (preg_match('#^' . $routePattern . '$#', $uri, $matches)) {
                array_shift($matches);
                if (is_callable($callback)) {
                    call_user_func_array($callback, $matches);
                } else {
                    list($controller, $method) = explode('@', $callback);
                    $controller = "App\\Controllers\\$controller";
                    call_user_func_array([new $controller, $method], $matches);
                }
                return;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
