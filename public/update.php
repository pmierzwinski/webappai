<?php

use App\App;
use App\TestClass;
use App\Api\Groq\GroqConnection;

// require_once "../app/autoload.php";
require_once "../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$connection = new GroqConnection();
$app = new App($connection);

//todo 1 update do poprawy działania
//todo potem update do poprawy wygladu
//itp itp


$app->updateProject();
header("Location: index.php");

die();