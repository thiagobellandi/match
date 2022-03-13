<?php

namespace App\Controller;

use App\database\UserDb;
use App\files\JwtGenerate;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Controller\BaseIni;

use PDO;

//
class CourseController extends BaseIni
{
    /**
     * @Route ("/course/delete")
     */
    public function delete()
    {
        //
        $this->BaseCourse();

        $tokenId = $this->getValue('token');

        //delete user in database
        $reply = $this->_courseDb->deleteCourse($tokenId);

        //encode jwt
        $jwt = $this->_jwt->encodeJwt($reply);

        return new Response($jwt);
    }

    /**
     * @Route ("/course/get")
     */
    public function get()
    {
        //
        $this->BaseCourse();

        $tokenId = $this->getValue('token');

        //
        $reply = $this->_courseDb->getCourse($tokenId);

        //encode jwt
        $token = $this->_jwt->encodeJwt($reply);

        return new Response($token);
    }

    /**
     * @Route ("/course/getall")
     */
    public function getAll()
    {
        //
        $this->BaseCourse();

        //get the list of users in database
        $result = $this->_courseDb->getCourses();
        $users= array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $users[] = $row;
        }
        $params['courses'] = $users;

        //encode jwt
        $token = $this->_jwt->encodeJwt($params);

        return new Response($token);
    }

    /**
     * @Route ("/course/edit")
     */
    public function edit()
    {
        //
        $this->BaseCourse();

        $title = $this->getValue('title');
        $description = $this->getValue('description');
        $dateStart = $this->getValue('datestart');
        $dateEnd = $this->getValue('dateend');
        $token = $this->getValue('token');

        //verify dates
        $reply = $this->checkDates($dateStart, $dateEnd);
        if ($reply['erro'] == "false")
        {
            $reply = $this->_courseDb->editCourse($title, $description, $dateStart, $dateEnd, $token);
        }

        //
        $jwt = $this->_jwt->encodeJwt($reply);

        return new Response($jwt);
    }

    //check dates
    public function checkDates($dateStart, $dateEnd)
    {
        $reply['erro'] = "false";
        $reply['msg'] = "";
        if (!$this->checkDate($dateStart))
        {
            $reply['erro'] = "true";
            $reply['msg'] = "Data inicial inválida";
        }
        else if (!$this->checkDate($dateEnd))
        {
            $reply['erro'] = "true";
            $reply['msg'] = "Data final inválida";
        }
        else if ($dateStart > $dateEnd)
        {
            $reply['erro'] = "true";
            $reply['msg'] = "A data inicial é maior que a data final";
        }

        return $reply;
    }

    /**
     * @Route ("/course/insert")
     */
    public function insert()
    {
        //
        $this->BaseCourse();

        $title = $this->getValue('title');
        $description = $this->getValue('description');
        $dateStart = $this->getValue('datestart');
        $dateEnd = $this->getValue('dateend');

        //verify dates
        $reply = $this->checkDates($dateStart, $dateEnd);
        if ($reply['erro'] == "false")
        {
            $reply = $this->_courseDb->insertCourse($title, $description, $dateStart, $dateEnd);
        }

        //
        $jwt = $this->_jwt->encodeJwt($reply);

        return new Response($jwt);
    }
}