<?php

use App\AI\Groq\GroqConnection;
use App\Update\UpdateService;

require_once "../vendor/autoload.php";
require_once "../bootstrap.php";


$connection = new GroqConnection();
$app = new UpdateService($connection);

//todo 1 update do poprawy działania
//todo potem update do poprawy wygladu
//itp itp


$app->updateProject();
header("Location: index.php");

die();