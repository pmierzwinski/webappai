<?php

class Utils
{
    public static function path($path) : string {
        return str_replace('/', DIRECTORY_SEPARATOR, str_replace('\\', DIRECTORY_SEPARATOR, $path));
    }

    public static function ensurePhpCode($code) : string {
        $code = htmlspecialchars_decode($code);

        $position = strpos($code, '<?php');
        // Usuń wszystko przed '<?php'
        if ($position !== false) {
            $cleanedText = substr($code, $position);
            return $cleanedText;
        } else {
            return $code;
        }
    }
}