<?php

require_once "../app/globalLoader.php";

$service = new GptService(new GptConnection(new GptApiMock()));
$app = new App($service);

$app->updateProject();

header("Location: index.php");

die();