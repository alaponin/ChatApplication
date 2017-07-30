<?php
/**
 * Created by PhpStorm.
 * User: arnelaponin
 */

require_once(dirname(__FILE__).'/../models/repositories/ParticipantRepository.php');

class MessageService {

    private $messageRepository;
    private $participantRepository;

    public function __construct() {
        $this->messageRepository = new MessageRepository();
        $this->participantRepository = new ParticipantRepository();
    }


    function findMessagesByConversation($conversation_id) {
        $messages = $this->messageRepository->findByConversationId($conversation_id);
        $messageDTOs = array();
        foreach ($messages as $message) {
            $messageDTO = $this->assembleMessageDTO($message);
            array_push($messageDTOs,$messageDTO);
        }
        return $messageDTOs;
    }

    function createMessage(\MessageDTO $messageDTO) {
        //Checking whether user is part of the conversation.
        $nrOfConversations = $this->checkUserPartOfConversation($messageDTO->getSenderId(), $messageDTO->getConversationId());
        $savedMessageDTO = null;
        if ($nrOfConversations > 0) {
            $message = new Message($messageDTO->jsonSerialize());
            $lastInsertedId = $this->messageRepository->save($message);
            $insertedMessage = $this->messageRepository->find($lastInsertedId);
            $savedMessageDTO = $this->assembleMessageDTO($insertedMessage);
            return $savedMessageDTO;
        } else return null;


    }

    private function checkUserPartOfConversation($user_id, $conversation_id) {
        return $this->participantRepository->checkParticipation($user_id, $conversation_id);

    }

    /**
     * @param $message
     * @return MessageDTO
     */
    public function assembleMessageDTO($message)
    {
        $messageDTO = new MessageDTO($message->getId(), $message->getSenderId(), $message->getConversationId(), $message->getBody());
        return $messageDTO;
    }

}