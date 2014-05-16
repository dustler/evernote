<?php

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\FormServiceProvider;

$app['locale'] = 'en';
$app['debug']  = true;

$app->register(new FormServiceProvider());

$app->register(new TwigServiceProvider(), array(
    'twig.path' => array(__DIR__.'/views'),
    'twig.options' => array('cache' => __DIR__.'/../cache/twig'),
));
