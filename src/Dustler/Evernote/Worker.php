<?php

namespace Dustler\Evernote;


use VT\Worker\Application;
use VT\Worker\WorkerInterface;

class Worker implements WorkerInterface
{
    protected $application;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->application = $app;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        $connection = new \AMQPConnection($this->application['amqp.options']);
        $connection->connect();

        $channel = new \AMQPChannel($connection);

        $queue = new \AMQPQueue($channel);
        $queue->setName('evernote');
        $queue->setFlags(AMQP_DURABLE);
        $queue->declareQueue();

        $app = $this->application;

        $queue->consume(function ($message, $queue) use (&$app) {
            $messageBody = $message->getBody();
            $json        = json_decode($messageBody, true);
            $store       = $app['evernote.client']->getNoteStore();

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
        });
    }
}
