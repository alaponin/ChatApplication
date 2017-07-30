<?php
/**
 * Created by PhpStorm.
 * User: arnelaponin
 */
class ConversationDTO implements JsonSerializable {

    private $id;
    private $title;
    private $participants = array();
    private $messages = array();

    /**
     * ConversationDTO constructor.
     * @param $id
     * @param $title
     * @param array $participants
     * @param array $messages
     */
    public function __construct($id, $title, array $participants, array $messages)
    {
        $this->id = $id;
        $this->title = $title;
        $this->participants = $participants;
        $this->messages = $messages;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return array
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * @param array $participants
     */
    public function setParticipants($participants)
    {
        $this->participants = $participants;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param array $messages
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
    }


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'participants' => $this->participants,
            'messages' => $this->messages,
        ];
    }
}