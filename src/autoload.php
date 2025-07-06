<?php

// $directories = [
//     "../app/interface/",
//     "../app/utils/",
//     "../app/api/",
//     "../app/api/gpt/",
//     "../app/api/test/",
//     "../app/api/groq/",
//     "../app/"
// ];

// foreach ($directories as $dir) {
//     foreach (glob($dir . "*.php") as $filename) {
//         require_once($filename);
//     }
// }


spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);

    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});