<?php
/**
 * Created by PhpStorm.
 * User: arnelaponin
 */

class Participant {

    public $id;
    public $conversation_id;
    public $user_id;

    public function __construct($data = null) {
        if (is_array($data)) {
            if (isset($data['id'])) $this->id = $data['id'];

            $this->conversation_id = $data['conversation_id'];
            $this->user_id = $data['user_id'];
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
    public function getConversationId()
    {
        return $this->conversation_id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }


}