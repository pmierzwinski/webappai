<?php

require_once "../app/globalLoader.php";

$connection = new GroqConnection();
$app = new App($connection);

//todo 1 update do poprawy działania
//todo potem update do poprawy wygladu
//itp itp

$app->updateProject();

header("Location: index.php");

die();