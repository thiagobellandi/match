<?php

namespace App\files;

use PDO;

class DatabaseMysql
{
    protected $_pdo;

    public function DatabaseMysql()
    {}

    public function Connect()
    {
        if (!isset($this->_pdo))
        {
            $this->_pdo = new PDO('mysql:host=34.148.53.153:3306;dbname=match', 'root', 'ZmQp!#@$00');
        }
    }

    public function getQuery($query)
    {
        $this->Connect();
        return $this->_pdo->query($query);
    }

    public function execQuery($query)
    {
        $this->Connect();
        $this->_pdo->query($query);
    }

    public function prepare($query)
    {
        $this->Connect();
        return $this->_pdo->prepare($query);
    }
}