<?php
/**
 * Created by PhpStorm.
 * User: arnelaponin
 */

class MessageDTO implements JsonSerializable {

    private $id;
    private $sender_id;
    private $conversation_id;
    private $body;

    /**
     * MessageDTO constructor.
     * @param $id
     * @param $sender_id
     * @param $conversation_id
     * @param $body
     */
    public function __construct($id, $sender_id, $conversation_id, $body)
    {
        $this->id = $id;
        $this->sender_id = $sender_id;
        $this->conversation_id = $conversation_id;
        $this->body = $body;
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


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'sender_id' => $this->sender_id,
            'conversation_id' => $this->conversation_id,
            'body' => $this->body,
        ];
    }
}