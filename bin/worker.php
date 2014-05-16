<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new VT\Worker\Application();

require_once __DIR__ . '/../resources/config/prod.php';

$app->register(new \VT\Provider\EvernoteServiceProvider());
$app['handler'] = function ($a) {
    return new Dustler\Evernote\Worker($a);
};

$app->run();
