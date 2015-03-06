<?php

class Users extends \Phalcon\Mvc\Model
{

    protected $id;

    protected $name;

    protected $email;

    protected $password;


    // public function getSource()
    // {
    //     return "users";
    // }

    // public function initialize()
    // {
    //     $this->setSource("users");
    // }

    public function onConstruct()
    {
        $this->setSource("users");
    }


    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        //The name is too short?
        if (strlen($name) < 10) {
            throw new \InvalidArgumentException('The name is too short');
        }
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
}