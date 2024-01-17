<?php

class Router
{
    private $routes = [];

    public function addRoute($uri, $controller, $method): void
    {
        $this->routes[$uri] = ['controller' => $controller, 'method' => $method];
    }

    public function route($uri, $db): void
    {
        if (!array_key_exists($uri, $this->routes)) {
            echo '404 Not Found';
            return;
        }

        $route = $this->routes[$uri];
        $controller = new $route['controller']($db);

        if (method_exists($controller, $route['method'])) {
            $controller->{$route['method']}();
        } else {
            echo '404 Not Found';
        }
    }
}