<?php

namespace Core;
use Core\Response;
class Router {
    protected $routes = [];
    public function get($uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'GET',
        ];
    }

    public function route($uri, $method)
    {
        foreach($this->routes as $route) {
            if($route['uri'] === $uri && $route['method'] === strtoupper($method) ) {
                return require base_path($route['controller']);
            }    
        }
        $this->abort();
    }

    protected function abort($code = Response::NOT_FOUND)
    {
        http_response_code($code);
        require base_path("views/{$code}.php");
        die();
    }
}