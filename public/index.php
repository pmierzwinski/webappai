<?php

use App\Framework\Framework;
use App\Framework\HandlersProvider;

require_once "../vendor/autoload.php";

$framework = new Framework();
$framework->run(Framework::DEV);

$provider = new HandlersProvider();
$provider->getHandlerOf($_SERVER['REQUEST_URI'])->handle();



