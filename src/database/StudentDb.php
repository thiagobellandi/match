<?php

namespace App\database;

use App\files\DatabaseMysql;
use Symfony\Component\VarDumper\Cloner\Data;

use PDO;

class StudentDb
{
    protected $_baseDb;
    protected $_reply;

    //
    public function StudentDb()
    {
        if (!isset($this->_baseDb))
        {
            $this->_baseDb = new DatabaseMysql();
        }
    }

    //
    public function editStudent($name, $mail, $bithday, $status, $tokenId)
    {
        $this->StudentDb();
        if ($this->checkStudentToken($tokenId))
        {
            $query = " UPDATE student 
                            SET stud_name = '$name',
                                stud_mail = '$mail', 
                                stud_birthday = '$bithday',
                                stud_status = '$status'
                            WHERE stud_token = '$tokenId' ";
            $this->_baseDb->execQuery($query);

            $this->_reply['msg'] = "Os dados do aluno foram editados";
            $this->_reply['status'] = "true";
        }
        else
        {
            $this->_reply['msg'] = "Este aluno não existe";
            $this->_reply['status'] = "false";
        }
        return $this->_reply;
    }

    //
    public function insertStudent($name, $mail, $birthday, $status)
    {
        $this->StudentDb();
        $tokenId = md5(uniqid(rand(), true));
        if (!$this->checkStudentMail($mail))
        {
            $query = " INSERT INTO student (stud_name, stud_mail, stud_birthday, stud_status, stud_token) 
                                         VALUES 
                                        ('$name','$mail', '$birthday', '$status', '$tokenId') ";
            $this->_baseDb->execQuery($query);
            echo $query;
            if ($this->checkStudentMail($mail))
            {
                $this->_reply['msg'] = "Aluno cadastrado com sucesso";
                $this->_reply['status'] = "true";
            }
            else
            {
                $this->_reply['msg'] = "Erro ao cadastrar aluno";
                $this->_reply['status'] = "false";
            }
        }
        else
        {
            $this->_reply['msg'] = "Já existe um aluno com este email";
            $this->_reply['status'] = "false";
        }
        return $this->_reply;
    }

    //
    public function deleteStudent($tokenId)
    {
        $this->StudentDb();
        //check if the studen exist
        $reply = $this->getStudent($tokenId);
        if ($reply['status'] == "true")
        {
            $query = " DELETE FROM student WHERE stud_token = ? ";
            $result = $this->_baseDb->preapre($query);
            $result->execute(array($tokenId));

            //Confirm if the student was deleted
            if ($this->getStudent($tokenId))
            {
                $this->_reply['msg'] = "aluno excluido";
                $this->_reply['status'] = "true";
            } else
            {
                $this->_reply['msg'] = "Erro ao excluir curso";
                $this->_reply['status'] = "false";
            }
        }
        else
        {
            $this->_reply['msg'] = "Este aluno não existe";
            $this->_reply['status'] = "false";
        }

        return $this->_reply;
    }

    //
    public function getStudents()
    {
        $this->StudentDb();
        $query = " SELECT * FROM student ORDER BY stud_name ";
        return $this->_baseDb->getQuery($query);
    }

    //
    public function checkStudentAble($studentId)
    {
        $this->StudentDb();
        $query = " SELECT * FROM student WHERE stud_id = ? AND stud_status = ? ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($studentId, '1'));
        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            return true;
        }
        return false;
    }

    //
    public function getStudentYears($studentId)
    {
        $date = date('Y-m-d');
        $this->StudentDb();
        $query = " SELECT TIMESTAMPDIFF(YEAR, stud_birthday, ?) AS years
                        FROM student 
                        WHERE stud_id = ? ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($date, $studentId));
        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            return $row['years'];
        }
        return 0;
    }

    //
    public function checkStudentToken($tokenId)
    {
        $this->StudentDb();
        $query = " SELECT * FROM student WHERE stud_token = ? ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($tokenId));
        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            return true;
        }
        return false;
    }

    //
    public function getStudent($tokenId)
    {
        $this->StudentDb();
        $query = " SELECT * FROM student WHERE stud_token = / ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($tokenId));
        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $this->_reply['student'] = $row;
            $this->_reply['msg'] = "";
            $this->_reply['status'] = "true";
        }
        else
        {
            $this->_reply['msg'] = "Este aluno nao existe";
            $this->_reply['status'] = "false";
        }
        return $this->_reply;
    }

    //
    public function checkStudentMail($mail)
    {
        $this->StudentDb();
        $query = " SELECT * FROM student WHERE stud_mail = ? ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($mail));
        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            return true;
        }

        return false;
    }
}