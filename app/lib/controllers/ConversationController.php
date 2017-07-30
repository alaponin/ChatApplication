<?php
/**
 * Created by PhpStorm.
 * User: arnelaponin
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once(dirname(__FILE__).'/../services/MessageService.php');
require_once(dirname(__FILE__).'/../services/ConversationService.php');
require_once(dirname(__FILE__).'/../services/dtos/MessageDTO.php');
require_once(dirname(__FILE__).'/../models/repositories/ConversationRepository.php');


class ConversationController {

    public function getUserConversations(Request $request, Response $response) {
        $id = $request->getAttribute('user_id');
        $conversationService = new ConversationService();
        $messages = $conversationService->findByUser($id);

        $newResponse = $this->prepapreResponse($response, $messages);

        return $newResponse;
    }

    public function getConversationMessages(Request $request, Response $response) {
        $id = $request->getAttribute('conversation_id');
        $messageService = new MessageService();
        $messages = $messageService->findMessagesByConversation($id);

        $newResponse = $this->prepapreResponse($response, $messages);

        return $newResponse;
    }

    public function getConversation(Request $request, Response $response) {
        $conversationId = $request->getAttribute('conversation_id');
        $conversationService = new ConversationService();
        $conversationDTO = $conversationService->find($conversationId);
        $newResponse = $this->prepapreResponse($response, $conversationDTO);

        return $newResponse;
    }

    public function createConversation(Request $request, Response $response) {
        $data = json_decode($request->getBody(), true);
        $conversationService = new ConversationService();

        $conversation = $conversationService->createConversation($data['title'], $data['creator_id']);
        $newResponse = $this->prepapreResponse($response, $conversation);

        return $newResponse->withStatus(201);
    }

    public function addParticipant(Request $request, Response $response) {
        $conversationId = $request->getAttribute('conversation_id');
        $data = json_decode($request->getBody(), true);

        $conversationService = new ConversationService();
        $savedParticipantId = $conversationService->addParticipant($conversationId, $data["user_id"]);

        if ($savedParticipantId == null) {
            return $response->withStatus(400);
        }

        $newResponse = $this->prepapreResponse($response, ["id" => $savedParticipantId]);

        return $newResponse->withStatus(201);
    }

    public function getConversationParticipants(Request $request, Response $response) {
        $conversationId = $request->getAttribute('conversation_id');
        $conversationService = new ConversationService();
        $participants = $conversationService->getConversationParticipants($conversationId);
        $newResponse = $this->prepapreResponse($response, $participants);

        return $newResponse;
    }

    public function createMessage(Request $request, Response $response) {
        $conversationId = $request->getAttribute('conversation_id');
        $data = json_decode($request->getBody(), true);

        $messageDTO = new MessageDTO(null, $data['sender_id'], $conversationId, $data['body']);
        $messageService = new MessageService();
        $savedMessage = $messageService->createMessage($messageDTO);
        if ($savedMessage == null) {
            return $response->withStatus(400);
        } else {
            $newResponse = $this->prepapreResponse($response, $savedMessage);

            return $newResponse->withStatus(201);
        }

    }

    /**
     * @param Response $response
     * @param $messages
     * @return Response
     */
    private function prepapreResponse(Response $response, $data) {
        $newResponse = $response->withHeader('Content-type', 'application/json');
        $newResponse->getBody()->write(json_encode($data));
        return $newResponse;
    }


}