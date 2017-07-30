<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require_once(dirname(__FILE__).'/../lib/controllers/ConversationController.php');

$app->group('/api', function () use ($app) {

    $app->group('/conversations', function () use ($app) {

        $app->get('/{conversation_id}', function (Request $request, Response $response) {
            return (new ConversationController)->getConversation($request,$response);
        });

        $app->post('', function (Request $request, Response $response) {
            return (new ConversationController)->createConversation($request,$response);
        });

        $app->get('/{conversation_id}/messages', function (Request $request, Response $response) {
            return (new ConversationController)->getConversationMessages($request,$response);
        });

        $app->post('/{conversation_id}/messages', function (Request $request, Response $response) {
            return (new ConversationController)->createMessage($request,$response);
        });

        $app->get('/{conversation_id}/participants', function (Request $request, Response $response) {
            return (new ConversationController)->getConversationParticipants($request,$response);

        });

        $app->post('/{conversation_id}/participants', function (Request $request, Response $response) {
            return (new ConversationController)->addParticipant($request,$response);
        });

    });

    $app->group('/users', function () use ($app) {

        $app->get('/{user_id}/conversations', function(Request $request, Response $response) {
            return (new ConversationController)->getUserConversations($request,$response);
        });
    });

});