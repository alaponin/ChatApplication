<?php
/**
 * Created by PhpStorm.
 * User: arnelaponin
 */
require_once(dirname(__FILE__).'/../models/repositories/ConversationRepository.php');
require_once(dirname(__FILE__).'/../models/repositories/UserRepository.php');
require_once(dirname(__FILE__).'/../models/repositories/MessageRepository.php');
require_once(dirname(__FILE__).'/../models/repositories/ParticipantRepository.php');
require_once(dirname(__FILE__).'/dtos/UserDTO.php');
require_once(dirname(__FILE__).'/dtos/ConversationDTO.php');

class ConversationService {

    private $conversationRepository;
    private $userRepository;
    private $messageRepository;
    private $participantRepository;


    public function __construct() {
        $this->conversationRepository = new ConversationRepository();
        $this->userRepository = new UserRepository();
        $this->messageRepository = new MessageRepository();
        $this->participantRepository = new ParticipantRepository();
    }

    function find($id) {
        $conversation = $this->conversationRepository->find($id);
        $savedConversationDTO = $this->getFullConversationData($conversation);
        return $savedConversationDTO;
    }

    function findByUser($user_id) {
        $conversations = $this->conversationRepository->findByUserId($user_id);
        $conversationDTOs = array();

        foreach ($conversations as $conversation) {
            $conversationDTO = $this->getFullConversationData($conversation);
            array_push($conversationDTOs, $conversationDTO);
        }
        return $conversationDTOs;
    }

    function createConversation($title, $creator_id) {
        $conversationData = array("title" => $title, "creator_id" => $creator_id);

        $conversation = new Conversation($conversationData);
        $savedConversationId = $this->conversationRepository->save($conversation);
        $participantData = array("conversation_id" => $savedConversationId, "user_id" => $creator_id);
        $participant = new Participant($participantData);
        $savedParticipantId = $this->participantRepository->save($participant);

        $savedConversation = $this->conversationRepository->find($savedConversationId);
        $savedConversationDTO = $this->getFullConversationData($savedConversation);
        return $savedConversationDTO;
    }

    /**
     * @param $conversation
     * @return ConversationDTO
     */
    public function getFullConversationData($conversation)
    {
        $conversationId = $conversation->getId();
        $conversationParticipants = $this->userRepository->findByConversationId($conversationId);
        $messages = $this->messageRepository->findByConversationId($conversationId);

        $userDTOs = array();
        foreach ($conversationParticipants as $participant) {
            $userDTO = new UserDTO($participant->id, $participant->name);
            array_push($userDTOs, $userDTO);
        }
        $conversationDTO = new ConversationDTO($conversation->id, $conversation->title, $userDTOs, $messages);
        return $conversationDTO;
    }

    public function addParticipant($conversationId, $userId) {
        $participantData = array("conversation_id" => $conversationId, "user_id" => $userId);
        //Checking if an user is already part of the conversation.
        $nrOfConversations = $this->participantRepository->checkParticipation($userId, $conversationId);
        if ($nrOfConversations == 0) {
            $participant = new Participant($participantData);
            $savedParticipantId = $this->participantRepository->save($participant);
            return $savedParticipantId;
        } else return null;
    }

    public function getConversationParticipants($conversationId) {
        $users = $this->userRepository->findByConversationId($conversationId);
        $userDTOs = array();
        foreach($users as $user) {
            $userDTO = new UserDTO($user->getId(), $user->getName());
            array_push($userDTOs, $userDTO);
        }
        return $userDTOs;
    }

}