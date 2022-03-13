<?php

namespace App\Controller;

use App\database\UserDb;
use App\files\JwtGenerate;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Controller\BaseIni;

use PDO;

//
class UserController extends BaseIni
{
    /**
     * @Route ("/user/delete")
     */
    public function delete()
    {
        //
        $this->BaseUser();

        $tokenId = $this->getValue('token');

        //delete user in database
        $reply = $this->_userDb->deleteUser($tokenId);

        //encode jwt
        $jwt = $this->_jwt->encodeJwt($reply);

        return new Response($jwt);
    }

    /**
     * @Route ("/user/get")
     */
    public function get()
    {
        //
        $this->BaseUser();

        $tokenId = $this->getValue('token');

        //
        $reply = $this->_userDb->getUser($tokenId);

        //encode jwt
        $token = $this->_jwt->encodeJwt($reply);

        return new Response($token);
    }

    /**
     * @Route ("/user/getall")
     */
    public function getAll()
    {
        //
        $this->BaseUser();

        //get the list of users in database
        $result = $this->_userDb->getUsers();
        $users= array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $users[] = $row;
        }
        $params['users'] = $users;

        //encode jwt
        $token = $this->_jwt->encodeJwt($params);

        return new Response($token);
    }

    /**
     * @Route ("/user/edit")
     */
    public function edit()
    {
        //
        $this->BaseUser();

        $name = $this->getValue('name');
        $mail = $this->getValue('mail');
        $status = $this->getValue('status');
        $token = $this->getValue('token');

        //
        $reply = $this->_userDb->editUser($name, $mail, $status, $token);

        //
        $jwt = $this->_jwt->encodeJwt($reply);

        return new Response($jwt);
    }

    /**
     * @Route ("/user/insert")
     */
    public function insert()
    {
        //
        $this->BaseUser();

        $name = $this->getValue('name');
        $mail = $this->getValue('mail');
        $password = $this->getValue('password');
        $status = $this->getValue('status');

        //
        if ($name && $mail && $password && $status) {
            $reply = $this->_userDb->insertUser($name, $mail, $password, $status);
        }
        else
        {
            $reply['erro'] = "true";
            $reply['msg'] = "Por favor, informar todas as informacoes";
        }

        //
        $jwt = $this->_jwt->encodeJwt($reply);

        return new Response($jwt);
    }
}