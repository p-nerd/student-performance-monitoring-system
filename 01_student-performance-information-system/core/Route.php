<?php

namespace Core;

class Route
{
    private static $routes = [];

    public static function get(string $path, $callback)
    {
        self::make($path, "GET", $callback);
    }

    public static function post(string $path, $callback)
    {
        self::make($path, "POST", $callback);
    }

    public static function put(string $path, $callback)
    {
        self::make($path, "PUT", $callback);
    }

    public static function patch(string $path, $callback)
    {
        self::make($path, "PATCH", $callback);
    }

    public static function delete(string $path, $callback)
    {
        self::make($path, "DELETE", $callback);
    }

    protected static function make(string $path, string $method, $callback)
    {
        self::$routes[$path][$method] = $callback;
    }

    public static function resolve(): string
    {
        $path = self::path();
        $method = self::method();

        if (!isset(self::$routes[$path][$method])) {
            abort("Route not found", 404);
        }

        $callback = self::$routes[$path][$method];

        return self::run($callback);
    }

    protected static function path()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    protected static function method()
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    protected static function run($callback): string
    {
        switch (true) {
            case is_array($callback):
                return self::handleArray($callback);
            case is_callable($callback):
                return self::handleFunction($callback);
            default:
                abort("Invalid callback");
        }
    }

    protected static function handleArray(array $callback): string
    {
        if (!class_exists($callback[0]) || !method_exists($callback[0], $callback[1])) {
            abort("function not exist: {$callback[1]}");
        }
        return call_user_func([new $callback[0], $callback[1]]) ?? "";
    }

    protected static function handleFunction($callback): string
    {
        return call_user_func($callback) ?? "";
    }
}
