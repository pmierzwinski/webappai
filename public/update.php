<?php

require_once "../app/globalLoader.php";

$connection = new GptConnection();
$app = new App($connection);

$app->updateProject();

header("Location: index.php");

die();