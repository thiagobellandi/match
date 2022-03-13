<?php

namespace App\Controller;

use App\database\UserDb;
use App\files\JwtGenerate;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Controller\BaseIni;

use PDO;

//
class RegistrationController extends BaseIni
{
    /**
     * @Route ("/registration/delete")
     */
    public function delete()
    {
        //
        $this->BaseRegistration();

        $tokenId = $this->getValue('token');

        //delete user in database
        $reply = $this->_registrationDb->deleteRegistration($tokenId);

        //encode jwt
        $jwt = $this->_jwt->encodeJwt($reply);

        return new Response($jwt);
    }

    /**
     * @Route ("/registration/get")
     */
    public function get()
    {
        //
        $this->BaseRegistration();

        $tokenId = $this->getValue('token');

        //
        $reply = $this->_registrationDb->getRegistration($tokenId);

        //encode jwt
        $token = $this->_jwt->encodeJwt($reply);

        return new Response($token);
    }

    /**
     * @Route ("/registration/getall")
     */
    public function getAll()
    {
        //
        $this->BaseRegistration();

        //get the list of registrations in database
        $result = $this->_registrationDb->getRegistrations();
        $registrations = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $registrations[] = $row;
        }
        $params['registrations'] = $registrations;

        //encode jwt
        $token = $this->_jwt->encodeJwt($params);

        return new Response($token);
    }

    /**
     * @Route ("/registration/edit")
     */
    public function edit()
    {
        //
        $this->BaseRegistration();
        $this->BaseStudent();
        $this->BaseCourse();
        $this->BaseUser();

        //
        $token = $this->getValue('token');
        $course = $this->_courseDb->getCourse($this->getValue('course'));
        $student = $this->_studentDb->getStudent($this->getValue('student'));

        //
        $userId = 1;

        //
        $reply = $this->checkRegistrationPermissions($course, $student);

        //chek if exist error
        if ($reply['erro'] == "false")
        {
            $reply = $this->_registrationDb->editRegistration($course['course']['cour_id'], $student['student']['stud_id'], $token);
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
     * @Route ("/registration/insert")
     */
    public function insert()
    {
        //
        $this->BaseRegistration();
        $this->BaseStudent();
        $this->BaseCourse();
        $this->BaseUser();

        //
        $course = $this->_courseDb->getCourse($this->getValue('course'));
        $student = $this->_studentDb->getStudent($this->getValue('student'));

        //
        $userId = $this->getUserId();

        //
        $reply = $this->checkRegistrationPermissions($course, $student);

        //chek if exist error
        if ($reply['erro'] == "false")
        {
            $reply = $this->_registrationDb->insertRegistration($userId, $course['course']['cour_id'], $student['student']['stud_id']);
        }

        //
        $jwt = $this->_jwt->encodeJwt($reply);

        return new Response($jwt);
    }

    //
    public function checkRegistrationPermissions($course, $student)
    {
        //Check Permissions
        $reply['erro'] = "false";

        //
        $courseId = 0;
        if (!isset($course['course']['cour_id']))
        {
            $reply['erro'] = "true";
            $reply['msg'] = $course['msg'];
        }
        else
        {
            $courseId = $course['course']['cour_id'];
        }

        //
        $studentId = 0;
        if (!isset($student['student']['stud_id']))
        {
            $reply['erro'] = "true";
            $reply['msg'] = $student['msg'];
        }
        else
        {
            $studentId = $student['student']['stud_id'];
        }

        //Verify permissions
        if ($reply['erro'] == "false")
        {
            if (!$this->_courseDb->checkCourseDatePermission($courseId))
            {
                $reply['erro'] = "true";
                $reply['msg'] = "Este curso já começou";
            }
            else if (!$this->_studentDb->checkStudentAble($studentId))
            {
                $reply['erro'] = "true";
                $reply['msg'] = "Este aluno está desabilitado";
            }
            else if ($this->_studentDb->getStudentYears($studentId) < 16)
            {
                $reply['erro'] = "true";
                $reply['msg'] = "Este aluno é menor de 16 anos";
            }
            else if ($this->_registrationDb->getRegistrationsCourseNum($courseId) > 9)
            {
                $reply['erro'] = "true";
                $reply['msg'] = "Este curso já está no limite maximo de 10 alunos";
            }
        }

        return $reply;
    }
}