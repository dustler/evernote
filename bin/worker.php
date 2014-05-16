<?php

require_once __DIR__ . '/../vendor/autoload.php';

$application = new VT\Worker\Application();

$application->register(new \VT\Provider\EvernoteServiceProvider());

$application['handler'] = function ($app) {
    return new Dustler\Evernote\Worker($app);
};
$application->run();
