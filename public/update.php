<?php

use App\App;
use App\Api\Groq\GroqConnection;

require_once "../app/autoload.php";

$connection = new GroqConnection();
$app = new App($connection);

//todo 1 update do poprawy działania
//todo potem update do poprawy wygladu
//itp itp


$test = new TestClass();

echo $html;
echo $test->sayHello();
$app->updateProject();

header("Location: index.php");

die();