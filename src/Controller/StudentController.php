<?php

namespace App\Controller;

use App\database\UserDb;
use App\files\JwtGenerate;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Controller\BaseIni;

use PDO;

//
class StudentController extends BaseIni
{
    /**
     * @Route ("/student/delete")
     */
    public function StudentController()
    {
        //
        $this->BaseStudent();

        $tokenId = $this->getValue('token');

        //delete user in database
        $reply = $this->_studentDb->deleteStudent($tokenId);

        //encode jwt
        $jwt = $this->_jwt->encodeJwt($reply);

        return new Response($jwt);
    }

    /**
     * @Route ("/student/get")
     */
    public function get()
    {
        //
        $this->BaseStudent();

        $tokenId = $this->getValue('token');

        //
        $reply = $this->_studentDb->getStudent($tokenId);

        //encode jwt
        $token = $this->_jwt->encodeJwt($reply);

        return new Response($token);
    }

    /**
     * @Route ("/student/getall")
     */
    public function getAll()
    {
        //
        $this->BaseStudent();

        //get the list of student in database
        $result = $this->_studentDb->getStudents();
        $users= array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $users[] = $row;
        }
        $params['students'] = $users;

        //encode jwt
        $token = $this->_jwt->encodeJwt($params);

        return new Response($token);
    }

    /**
     * @Route ("/student/edit")
     */
    public function edit()
    {
        //
        $this->BaseStudent();

        $name = $this->getValue('name');
        $mail = $this->getValue('mail');
        $birthday = $this->getValue('birthday');
        $status = $this->getValue('status');
        $token = $this->getValue('token');

        //verify date
        if ($this->checkDate($birthday))
        {
            $reply = $this->_studentDb->editStudent($name, $mail, $birthday, $status, $token);
        }
        else
        {
            $reply['erro'] = "true";
            $reply['msg'] = "data de aniversário inválida";
        }

        //
        $jwt = $this->_jwt->encodeJwt($reply);

        return new Response($jwt);
    }

    /**
     * @Route ("/student/insert")
     */
    public function insert()
    {
        //
        $this->BaseStudent();

        $name = $this->getValue('name');
        $mail = $this->getValue('mail');
        $birthday = $this->getValue('birthday');
        $status = $this->getValue('status');

        //verify date
        if ($this->checkDate($birthday))
        {
            $reply = $this->_studentDb->insertStudent($name, $mail, $birthday, $status);
        }
        else
        {
            $reply['erro'] = "true";
            $reply['msg'] = "Data de aniversário inválida";
        }

        //
        $jwt = $this->_jwt->encodeJwt($reply);

        return new Response($jwt);
    }
}