<?php

class Utils
{
    public static function path($path) : string {
        return str_replace('/', DIRECTORY_SEPARATOR, str_replace('\\', DIRECTORY_SEPARATOR, $path));
    }
}