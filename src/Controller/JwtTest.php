<?php

namespace App\Controller;

use App\files\JwtGenerate;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class JwtTest
{
    /**
     * @Route ("/teste")
     */
    public function teste()
    {
        //
        $key = '@#4!#09$3';

        //
        $params = array();

/*        $params['title'] = "ciencias";
        $params['description'] = "materia de ciencias";
        $params['datestart'] = "2022-10-10";
        $params['dateend'] = "2022-11-10";
        $params['ltoken'] = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9";
*/
//        $params['login'] = "admin@match.mt";
        $params['ltoken'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9';

        $jwt = \Firebase\JWT\JWT::encode($params, $key, 'HS256');

        return new Response($jwt);
    }
}