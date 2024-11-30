<?php

require_once "../app/globalLoader.php";

$app = new App(new GptMock());
$app->updateProject();

header("Location: index.php");
die();