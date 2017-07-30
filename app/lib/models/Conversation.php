<?php
/**
 * Created by PhpStorm.
 * User: arnelaponin
 */
class Conversation {

    public $id;
    public $title;
    public $creator_id;

    public function __construct($data = null)
    {
        if (is_array($data)) {
            if (isset($data['id'])) $this->id = $data['id'];

            $this->title = $data['title'];
            $this->creator_id = $data['creator_id'];
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getCreatorId()
    {
        return $this->creator_id;
    }


}