<?php

namespace app\classes;

class Router
{
    protected static $routes = [];
    protected static $root;

    protected static function init()
    {
        self::$routes = include('./routes/routes.php');
        self::$root = $_SERVER['DOCUMENT_ROOT'];
    }

    private static function match($route): bool
    {
        $route = explode('/', $route) ?? $route;

        if (preg_match('/^[А-ЯЁа-яёA-Za-z0-9-_\/%&=]+$/', $route[0]))
            return true;

        return false;
    }

    public static function route($route)
    {
        self::init();

        if (self::match($route)) {

            $template = self::getResource($route);

            if(array_key_exists($template, self::$routes)) {
                $file = self::$root . '/app/views/' . $template . '.php';

                if(file_exists($file)) include($file);
            }
            else {
                include(self::$root . '/app/views/404.php');
            }
        }
        else if(empty(trim($route))) {
            include(self::$root . '/app/views/home.php');
        }
        else {
            include(self::$root . '/app/views/404.php');
        }
    }

    public static function getResource($route) {
        $route = $route[0] == '/' ? mb_substr($route, 1) : $route;
        $explodeUrl = explode('/', $route);

        return $explodeUrl[0];
    }

    public static function parameters($route): array
    {
        $route = $route[0] == '/' ? mb_substr($route, 1) : $route;

        $explodeUrl = explode('/', $route);
        $explodeUri = explode('-', $explodeUrl[1]);

        $unique = end($explodeUri);

        array_pop($explodeUri);
        $resource = implode('-', $explodeUri);

        return array('alias' => $resource, 'unique' => $unique);
    }

    public static function alias($route): string
    {
        $route = $route[0] == '/' ? mb_substr($route, 1) : $route;
        $explodeUrl = explode('/', $route);

        return $explodeUrl[1];
    }

    public static function loadScripts(string $route): \Generator
    {
        $resource = self::getResource($route);
        $scripts = include_once($_SERVER['DOCUMENT_ROOT'] . '/routes/scripts.php');

        if(array_key_exists($resource, $scripts)) {
            foreach ($scripts[$resource] as $script)
                yield "<script src='/resources/js/{$script}.js'></script>";
        }
    }
}