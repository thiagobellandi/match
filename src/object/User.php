<?php

namespace App\object;

class User
{
    protected $_id;
    protected $_name;
    protected $_mail;
    protected $_status;

    public function User($id, $name, $mail, $status)
    {
        $this->_id = $id;
        $this->_name = $name;
        $this->_mail = $mail;
        $this->_status = $status;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getMail()
    {
        return $this->_mail;
    }

    public function getStatus()
    {
        return $this->_status;
    }
}