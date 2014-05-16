<?php

use Symfony\Component\HttpFoundation\Response;

use EDAM\Types\Data, EDAM\Types\Note, EDAM\Types\Resource, EDAM\Types\ResourceAttributes;
use EDAM\Error\EDAMUserException, EDAM\Error\EDAMErrorCode;
use EDAM\NoteStore\NoteFilter;

$app->match('/note/create/{userid}/{notebookid}/{noteid}', function ($userid = 1, $notebookid = 1, $noteid = 1) use ($app) {
    $note    = $app['evernote.note_store']->getNote($noteid, true, false, false, false);
    $message = array('title' => $note->title, 'payload' => $note->content);
    $app['amqp.exchange']->publish(json_encode($message), 'from_evernote');

    return new Response('OK', 200);
});
