<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

require_once __DIR__ . '/../resources/config/prod.php';
require_once __DIR__ . '/../resources/config/common.php';
require_once __DIR__ . '/../src/controllers.php';

$app->run();
