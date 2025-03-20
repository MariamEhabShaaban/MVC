<?php

namespace Sectheater\Mvc\Http;


use Sectheater\Mvc\Http\Response;
use Sectheater\Mvc\Http\Request;
use Sectheater\Mvc\View\View;

class Route
{
    public $request;
    public $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public static array $routes = [];
    public static function get($route, $action)
    {
        self::$routes['get'][$route] = $action;
    }
    public static function post($route, $action)
    {
        self::$routes['post'][$route] = $action;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $action = self::$routes[$method][$path] ?? false;

        if(!array_key_exists($path,self::$routes[$method])){
            View::makeError('404');
            return;
            

        }

        // 404 handling

        // callback
        if (is_callable($action)) {
            call_user_func_array($action, []);
        }
        if (is_array($action)) {
            call_user_func_array([new $action[0], $action[1]], []);
        }
    }
}