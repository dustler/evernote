<?php

require_once __DIR__ . '/../vendor/autoload.php';

$application = new VT\Worker\Application();
$application->register(new \VT\Provider\EvernoteServiceProvider());

/*$channel = new AMQPChannel($app['amqp.connection']);

$queue = new AMQPQueue($channel);
$queue->setName('evernote');
$queue->setFlags(AMQP_DURABLE);
$queue->declareQueue();

$queue->consume(function ($message, $queue) use (&$app) {
    $messageBody = $message->getBody();
    $json        = json_decode($messageBody, true);
    $store       = $app['evernote.note_store'];

    $payload = $json['payload'];
    if (is_array($payload)) {
        $payload = implode($payload);
    }

    $nBody = '<?xml version="1.0" encoding="UTF-8"?>';
    $nBody .= '<!DOCTYPE en-note SYSTEM "http://xml.evernote.com/pub/enml2.dtd">';
    $nBody .= '<en-note>' . $payload . '</en-note>';

    $note               = new Note();
    $note->notebookGuid = '';
    $note->content      = $nBody;
    $note->title        = $json['title'];

    try {
        $newnote = $store->createNote($note);
    } catch (Exception $e) {
        var_dump($e);
    }
    $queue->ack($message->getDeliveryTag());
});*/
