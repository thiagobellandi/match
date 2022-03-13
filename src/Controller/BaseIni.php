<?php

namespace App\Controller;

use App\database\LoginDb;
use App\database\UserDb;
use App\database\CourseDb;
use App\database\StudentDb;
use App\database\RegistrationDb;
use App\files\JwtGenerate;
use App\object\Course;
use App\object\User;
use PDO;

class BaseIni
{
    /**
     * @var UserDb
     */
    protected $_userDb;

    /**
     * @var CourseDb
     */
    protected $_courseDb;

    /**
     * @var StudentDb
     */
    protected $_studentDb;

    /**
     * @var RegistrationDb
     */
    protected $_registrationDb;

    /**
     * @var LoginDb
     */
    protected $_loginDb;


    protected $_jwt;

    protected $_jwtParams;

    function baseJwt()
    {
        //
        if (!isset($this->_jwt))
        {
            $this->_jwt = new JwtGenerate();
        }
    }

    //
    public function Base()
    {
        $this->baseJwt();

        //
        if (!isset($this->_loginDb))
        {
            $this->_loginDb = new LoginDb();
        }

        //check access permission
        if (!$this->_loginDb->checkLoginToken($this->getValue('ltoken')))
        {
            //
            $reply['erro'] = "true";
            $reply['msg'] = "Acesso não permitido. Token de login não informádo ou inválido";

            //
            $jwt = $this->_jwt->encodeJwt($reply);

            echo $jwt;

            exit;
        }
    }

    //
    public function BaseLogin()
    {
        $this->baseJwt();
        //
        if (!isset($this->_loginDb))
        {
            $this->_loginDb = new LoginDb();
        }
    }

    //
    public function BaseUser()
    {
        $this->Base();

        //
        if (!isset($this->_userDb))
        {
            $this->_userDb = new UserDb();
        }
    }

    //
    public function BaseCourse()
    {
        $this->Base();

        //
        if (!isset($this->_courseDb))
        {
            $this->_courseDb = new CourseDb();
        }
    }

    //
    public function BaseStudent()
    {
        $this->Base();

        //
        if (!isset($this->_studentDb))
        {
            $this->_studentDb = new StudentDb();
        }
    }

    //
    public function BaseRegistration()
    {
        $this->Base();

        //
        if (!isset($this->_registrationDb))
        {
            $this->_registrationDb = new RegistrationDb();
        }
    }

    //
    public function getValue($value)
    {
        if (isset($_GET[$value]))
        {
            return $_GET[$value];
        }

        return "";
    }

    //
    public function checkDate($date)
    {
        if (isset($date))
        {
            $tempDate = explode('-', $date);
            //verifica se a data informada é válida
            if (isset($tempDate[1]) && isset($tempDate[0]) && isset($tempDate[2]))
            {
                if (is_numeric($tempDate[1]) && is_numeric($tempDate[0]) && is_numeric($tempDate[2])) {
                    if (checkdate($tempDate[1], $tempDate[2], $tempDate[0])) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}