<?php

require_once "../app/globalLoader.php";

$connection = new GroqConnection();
$app = new App($connection);

$app->updateProject();

header("Location: index.php");

die();