<?php

namespace App\database;

use App\files\DatabaseMysql;
use Symfony\Component\VarDumper\Cloner\Data;

use PDO;

class LoginDb
{
    protected $_baseDb;
    protected $_reply;

    //
    public function LoginDb()
    {
        if (!isset($this->_baseDb))
        {
            $this->_baseDb = new DatabaseMysql();
        }
    }

    //
    public function makeLogin($login, $password)
    {
        $this->LoginDb();
        $query = " SELECT * 
                        FROM user 
                        WHERE user_mail = ? 
                            AND user_password = ? ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($login, $password));
        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            return $row['user_token'];
        }
        return false;
    }

    //
    public function checkLoginToken($token)
    {
        //
        $this->LoginDb();

        //
        if (!$token)
        {
            return false;
        }

        //
        $query = " SELECT * 
                        FROM user 
                        WHERE user_token = ? ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($token));
        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            return $row['user_token'];
        }
        return false;
    }

    //
    public function checkToken($token)
    {
        $this->LoginDb();
        $query = " SELECT * 
                        FROM user 
                        WHERE user_token = ?  ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($token));
        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            return true;
        }
        return false;
    }
}