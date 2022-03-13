<?php

namespace App\database;

use App\files\DatabaseMysql;
use Symfony\Component\VarDumper\Cloner\Data;

use PDO;

class UserDb
{
    protected $_baseDb;
    protected $_reply;

    //
    public function UserDb()
    {
        if (!isset($this->_baseDb))
        {
            $this->_baseDb = new DatabaseMysql();
        }
    }

    //
    public function editUser($name, $mail, $status, $tokenId)
    {
        $this->UserDb();
        if ($this->checkUserToken($tokenId))
        {
            $query = " UPDATE user 
                            SET user_name = ?,
                                user_mail = ?, 
                                user_status = ?
                            WHERE user_token = ? ";
            $result = $this->_baseDb->prepare($query);
            $result->execute(array($name, $mail, $status, $tokenId));

            $this->_reply['msg'] = "Os dados do usuários foram editados com sucesso";
            $this->_reply['status'] = "true";
        }
        else
        {
            $this->_reply['msg'] = "Este usuário não existe";
            $this->_reply['status'] = "false";
        }
        return $this->_reply;
    }

    //
    public function insertUser($name, $mail, $password, $status)
    {
        $this->UserDb();
        $tokenId = md5(uniqid(rand(), true));
        $password = md5($password);
        if (!$this->checkUserMail($mail))
        {
            $query = " INSERT INTO user (user_name, user_mail, user_status, user_password, user_token) 
                                         VALUES 
                                        (?, ?, ?, ?, ?) ";
            $result = $this->_baseDb->prepare($query);
            $result->execute(array($name, $mail, $status, $password, $tokenId));
            if ($this->checkUserMail($mail))
            {
                $this->_reply['msg'] = "Usuário cadastrado com sucesso";
                $this->_reply['status'] = "true";
            }
            else
            {
                $this->_reply['msg'] = "Erro ao cadastrar usuario";
                $this->_reply['status'] = "false";
            }
        }
        else
        {
            $this->_reply['msg'] = "Já existe um usuário com este email";
            $this->_reply['status'] = "false";
        }
        return $this->_reply;
    }

    //
    public function deleteUser($tokenId)
    {
        $this->UserDb();
        $reply = $this->getUser($tokenId);
        if ($reply['status'] == "true")
        {
            $query = " DELETE FROM user WHERE user_token = ? ";
            $result = $this->_baseDb->prepare($query);
            $result->execute(array($tokenId));

            //Confirm if the user was deleted
            if ($this->getUser($tokenId))
            {
                $this->_reply['msg'] = "Usuário excluido";
                $this->_reply['status'] = "true";
            }
            else
            {
                $this->_reply['msg'] = "Erro ao excluir usuario";
                $this->_reply['status'] = "false";
            }
        }
        else
        {
            $this->_reply['msg'] = "Este usuário não existe";
            $this->_reply['status'] = "false";
        }

        return $this->_reply;
    }

    //
    public function getUsers()
    {
        $this->UserDb();
        $query = " SELECT * FROM user ORDER BY user_name";
        return $this->_baseDb->getQuery($query);
    }

    //
    public function checkUserToken($tokenId)
    {
        $this->UserDb();
        $query = " SELECT * FROM user WHERE user_token = ? ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($tokenId));
        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            return true;
        }
        return false;
    }

    //
    public function getUser($tokenId)
    {
        $this->UserDb();
        $query = " SELECT * FROM user WHERE user_token = ? ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($tokenId));
        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $this->_reply['user'] = $row;
            $this->_reply['msg'] = "";
            $this->_reply['status'] = "true";
        }
        else
        {
            $this->_reply['msg'] = "Usuário nao existe";
            $this->_reply['status'] = "false";
        }
        return $this->_reply;
    }

    //
    public function checkUserMail($mail)
    {
        $this->UserDb();
        $query = " SELECT * FROM user WHERE user_mail = ? ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($mail));
        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            return true;
        }

        return false;
    }
}