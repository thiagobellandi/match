<?php

namespace App\database;

use App\files\DatabaseMysql;
use Symfony\Component\VarDumper\Cloner\Data;

use PDO;

class CourseDb
{
    protected $_baseDb;
    protected $_reply;

    //
    public function CourseDb()
    {
        if (!isset($this->_baseDb))
        {
            $this->_baseDb = new DatabaseMysql();
        }
    }

    //
    public function editCourse($title, $description, $dateBegin, $dateEnd, $tokenId)
    {
        $this->CourseDb();
        if ($this->checkCourseToken($tokenId))
        {
            $query = " UPDATE course 
                            SET cour_title = '$title',
                                cour_description = '$description', 
                                cour_date_start = '$dateBegin',
                                cour_date_end = '$dateEnd'
                            WHERE cour_token = '$tokenId' ";
            $this->_baseDb->execQuery($query);

            $this->_reply['msg'] = "Os dados do curso foram editados";
            $this->_reply['status'] = "true";
        }
        else
        {
            $this->_reply['msg'] = "Este curso não existe";
            $this->_reply['status'] = "false";
        }
        return $this->_reply;
    }

    //
    public function insertCourse($title, $description, $dateBegin, $dateEnd)
    {
        $this->CourseDb();
        $tokenId = md5(uniqid(rand(), true));
        if (!$this->checkCourseTitle($title))
        {
            $query = " INSERT INTO course (cour_title, cour_description, cour_date_start, cour_date_end, cour_token) 
                                         VALUES 
                                        ('$title','$description', '$dateBegin', '$dateEnd', '$tokenId') ";
            $this->_baseDb->execQuery($query);
            if ($this->checkCourseTitle($title))
            {
                $this->_reply['msg'] = "Curso cadastrado com sucesso";
                $this->_reply['status'] = "true";
            }
            else
            {
                $this->_reply['msg'] = "Erro ao cadastrar curso";
                $this->_reply['status'] = "false";
            }
        }
        else
        {
            $this->_reply['msg'] = "Já existe um curso com este nome";
            $this->_reply['status'] = "false";
        }
        return $this->_reply;
    }

    //
    public function deleteCourse($tokenId)
    {
        $this->CourseDb();
        //check if the course exist
        $reply = $this->getCourse($tokenId);
        if ($reply['status'] == "true")
        {
            $query = " DELETE FROM course WHERE cour_token = ? ";
            $result = $this->_baseDb->prepare($query);
            $result->execute(array($tokenId));

            //Confirm if the course was deleted
            if ($this->getCourse($tokenId))
            {
                $this->_reply['msg'] = "Curso excluido";
                $this->_reply['status'] = "true";
            } else
            {
                $this->_reply['msg'] = "Erro ao excluir curso";
                $this->_reply['status'] = "false";
            }
        }
        else
        {
            $this->_reply['msg'] = "Este curso não existe";
            $this->_reply['status'] = "false";
        }

        return $this->_reply;
    }

    //
    public function getCourses()
    {
        $this->CourseDb();
        $query = " SELECT * FROM course ORDER BY cour_date_start ";
        return $this->_baseDb->getQuery($query);
    }

    //
    public function checkCourseToken($tokenId)
    {
        $this->CourseDb();
        $query = " SELECT * FROM course WHERE cour_token = ? ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($tokenId));
        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            return true;
        }
        return false;
    }

    //
    public function checkCourseDatePermission($courseId)
    {
        $date = date('Y-m-d');

        $this->CourseDb();

        $query = " SELECT * 
                        FROM course 
                        WHERE cour_id = ?
                           AND cour_date_start > ? ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($courseId, $date));

        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            return true;
        }

        return false;
    }

    //
    public function getCourse($tokenId)
    {
        $this->CourseDb();
        $query = " SELECT * FROM course WHERE cour_token = ? ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($tokenId));
        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $this->_reply['course'] = $row;
            $this->_reply['msg'] = "";
            $this->_reply['status'] = "true";
        }
        else
        {
            $this->_reply['msg'] = "Este curso nao existe";
            $this->_reply['status'] = "false";
        }
        return $this->_reply;
    }

    //
    public function checkCourseTitle($title)
    {
        $this->CourseDb();
        $query = " SELECT * FROM course WHERE cour_title = ? ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($title));
        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            return true;
        }

        return false;
    }
}