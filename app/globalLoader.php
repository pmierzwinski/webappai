<?php

foreach (glob("../app/interface/*.php") as $filename) {
    require_once($filename);
}

foreach (glob("../app/utils/*.php") as $filename) {
    require_once($filename);
}

foreach (glob("../app/api/*.php") as $filename) {
    require_once($filename);
}
foreach (glob("../app/api/gpt/*.php") as $filename) {
    require_once($filename);
}

foreach (glob("../app/api/test/*.php") as $filename) {
    require_once($filename);
}

foreach (glob("../app/api/groq/*.php") as $filename) {
    require_once($filename);
}

foreach (glob("../app/*.php") as $filename) {
    require_once($filename);
}

