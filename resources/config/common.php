<?php

$app['amqp.connection'] = $app->share(function ($app) {
    $connection = new AMQPConnection();
    $connection->connect();

    return $connection;
});

$app['amqp.exchange'] = $app->share(function ($app) {
    $channel  = new AMQPChannel($app['amqp.connection']);
    $exchange = new AMQPExchange($channel);
    $exchange->setName('amq.direct');
    $exchange->setType(AMQP_EX_TYPE_DIRECT);
    $exchange->setFlags(AMQP_DURABLE);

    return $exchange;
});

$app['evernote.client'] = $app->share(function ($app) {
    return new Evernote\Client(array(
        'token' => ''
    ));
});

$app['evernote.note_store'] = $app->share(function ($app) {
    return $app['evernote.client']->getNoteStore();
});
