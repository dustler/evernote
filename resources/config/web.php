<?php

$app['amqp.connection'] = $app->share(function ($app) {
    $connection = new AMQPConnection($app['amqp.options']);
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
