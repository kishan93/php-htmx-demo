<?php

namespace App;

use App\Exceptions\HttpMethodNotSupportedException;
use App\Exceptions\RouteNotFoundException;
use BadMethodCallException;

class Router
{
    protected static array $routes = [];

    protected static array $supportedMethods = [
        'get', 'post', 'put', 'patch', 'delete', 'options', 'any',
    ];

    public function __construct()
    {
        //
    }

    public static function path(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public static function handle()
    {
        $path = static::path();
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        if (!array_key_exists($path, static::$routes)) {
            throw new RouteNotFoundException();
        }

        if(!array_key_exists($method, static::$routes[$path])) {
            throw new HttpMethodNotSupportedException($method);
        }

        $content = call_user_func(static::$routes[$path][$method], []);
        App::instance()->setContent($content);
    }

    public static function __callStatic($name, $arguments)
    {
        if (!in_array($name, static::$supportedMethods)) {
            throw new BadMethodCallException("method $name is not supported");
        }

        static::register($name, ...$arguments);
    }

    protected static function register(string $method, string $path, callable $handler)
    {
        static::$routes[$path][$method] = $handler;
    }
}
