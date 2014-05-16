<?php

$app->match('*', function (/*$userid = 1, $notebookid = 1, $noteid = 1*/) use ($app) {
    $message = array('title'   => '',
                     'payload' => array(/*'userId' => $userid, 'notebookid' => $notebookid, 'noteId' => $noteid*/)
    );
    $app['amqp.exchange']->publish(json_encode($message), 'evernote');

    return new Response('OK', 200);
});
