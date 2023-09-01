<?php

namespace App;

use App\Exceptions\HttpMethodNotSupportedException;
use App\Exceptions\InvalidRouteResolverException;
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
        $httpMethod = strtolower($_SERVER['REQUEST_METHOD']);

        if (!array_key_exists($path, static::$routes)) {
            throw new RouteNotFoundException();
        }

        if (!array_key_exists($httpMethod, static::$routes[$path])) {
            throw new HttpMethodNotSupportedException($httpMethod);
        }

        $action = static::$routes[$path][$httpMethod];

        if (is_callable($action)) {
            return call_user_func($action);
        }

        if (!is_array($action) || count($action) != 2) {
            throw new InvalidRouteResolverException();
        }

        [$class, $method] = $action;

        if(!class_exists($class)) {
            //TODO: check if class is instasiable
            throw new InvalidRouteResolverException($class." must be instasiable");
        }

        //TODO: introduce DI
        $instance = new $class;

        if(!method_exists($instance, $method)){
            throw new InvalidRouteResolverException($method ." does not exist on ". $class);
        }

        return call_user_func_array([$instance, $method], []);
    }

    public static function __callStatic($name, $arguments)
    {
        if (!in_array($name, static::$supportedMethods)) {
            throw new BadMethodCallException("method $name is not supported");
        }

        static::register($name, ...$arguments);
    }

    protected static function register(string $method, string $path, callable|array $handler)
    {
        static::$routes[$path][$method] = $handler;
    }
}
