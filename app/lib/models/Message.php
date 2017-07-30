<?php
/**
 * Created by PhpStorm.
 * User: arnelaponin
 */

class Message {

    public $id;
    public $sender_id;
    public $conversation_id;
    public $body;

    public function __construct($data = null) {
        if (is_array($data)) {
            if (isset($data['id'])) $this->id = $data['id'];

            $this->sender_id = $data['sender_id'];
            $this->conversation_id = $data['conversation_id'];
            $this->body = $data['body'];
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSenderId()
    {
        return $this->sender_id;
    }

    /**
     * @return mixed
     */
    public function getConversationId()
    {
        return $this->conversation_id;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }


}