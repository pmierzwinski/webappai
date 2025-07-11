<?php

use App\Framework\Framework;
use App\Framework\HandlersProvider;

require_once "../vendor/autoload.php";

$framework = new Framework();
$framework->createAplication(Framework::DEV, __DIR__."/../src");//todo src -> protected?





