<?php

namespace App\Controller;

use App\database\UserDb;
use App\files\JwtGenerate;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Controller\BaseIni;

use PDO;

//
class LoginController extends BaseIni
{
    /**
     * @Route ("/login/make")
     */
    public function make()
    {
        //
        $this->BaseLogin();

        //
        $login = $this->getValue('login');
        $password = md5($this->getValue('password'));

        //
        $token = $this->_loginDb->makeLogin($login, $password);
        if ($token)
        {
            $reply['token'] = $token;
            $reply['erro'] = "false";
            $reply['msg'] = "login valido";
        }
        else
        {
            $reply['erro'] = "true";
            $reply['msg'] = "login invalido";
        }

        //encode jwt
        $token = $this->_jwt->encodeJwt($reply);

        return new Response($token);
    }
}