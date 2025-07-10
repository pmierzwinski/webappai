<?php

namespace App\Route;

use App\Framework\HandlersProvider;

class Router
{
    public function handleRequest() : void
    {
        $provider = new HandlersProvider();
    }

    public static function get(string $path, callable $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === $path) {
            call_user_func($callback);
        }
    }
}