<?php
/**
 * Created by PhpStorm.
 * User: arnelaponin
 */

class User {

    public $id;
    public $name;
    public $email;
    public $password;

    public function __construct($data = null) {
        if (is_array($data)) {
            if (isset($data['id'])) $this->id = $data['id'];

            $this->name = $data['name'];
            $this->email = $data['email'];
            $this->password = $data['password'];
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }


}