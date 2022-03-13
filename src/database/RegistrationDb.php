<?php

namespace App\database;

use App\files\DatabaseMysql;
use Symfony\Component\VarDumper\Cloner\Data;

use PDO;

class RegistrationDb
{
    protected $_baseDb;
    protected $_reply;

    //
    public function RegistrationDb()
    {
        if (!isset($this->_baseDb))
        {
            $this->_baseDb = new DatabaseMysql();
        }
    }

    //
    public function editRegistration($studentId, $courseId, $tokenId)
    {
        $this->RegistrationDb();
        if ($this->checkRegistrationToken($tokenId))
        {
            $query = " UPDATE registration 
                            SET regi_stud_id = '$studentId', 
                                regi_cour_id = '$courseId'
                            WHERE regi_token = '$tokenId' ";
            $this->_baseDb->execQuery($query);

            $this->_reply['msg'] = "Os dados da matricula foram editados";
            $this->_reply['status'] = "true";
        }
        else
        {
            $this->_reply['msg'] = "Esta matricula não existe";
            $this->_reply['status'] = "false";
        }
        return $this->_reply;
    }

    //
    public function insertRegistration($userId, $courseId, $studentId)
    {
        $this->RegistrationDb();
        $tokenId = md5(uniqid(rand(), true));
        $date = date('Y-m-d');
        if (!$this->checkRegistration($courseId, $studentId))
        {
            $query = " INSERT INTO registration (regi_cour_id, regi_date, regi_stud_id, regi_user_id, regi_token) 
                                         VALUES 
                                        ('$courseId', '$date', '$studentId', '$userId', '$tokenId') ";
            $this->_baseDb->execQuery($query);
            if ($this->checkRegistration($courseId, $studentId))
            {
                $this->_reply['msg'] = "Matricula cadastrada com sucesso";
                $this->_reply['status'] = "true";
            }
            else
            {
                $this->_reply['msg'] = "Erro ao cadastrar matricula";
                $this->_reply['status'] = "false";
            }
        }
        else
        {
            $this->_reply['msg'] = "Já existe uma matricula deste aluno para este curso";
            $this->_reply['status'] = "false";
        }
        return $this->_reply;
    }

    //
    public function deleteRegistration($tokenId)
    {
        $this->RegistrationDb();
        //check if the ergistration exist
        if ($this->checkRegistrationToken($tokenId))
        {
            $query = " DELETE FROM registration WHERE regi_token = ? ";
            $this->_baseDb->prepare($query);
            $result->execute(array($tokenId));

            //Confirm if the registration was deleted
            if ($this->getRegistration($tokenId))
            {
                $this->_reply['msg'] = "Matrícula excluida";
                $this->_reply['status'] = "true";
            } else
            {
                $this->_reply['msg'] = "Erro ao excluir matricula";
                $this->_reply['status'] = "false";
            }
        }
        else
        {
            $this->_reply['msg'] = "Esta matricula não existe";
            $this->_reply['status'] = "false";
        }

        return $this->_reply;
    }

    //
    public function getRegistrationsCourseNum($courseId)
    {
        $this->RegistrationDb();
        $query = " SELECT count(*) AS total 
                        FROM registration 
                        WHERE regi_cour_id = ? ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($courseId));
        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            return $row['total'];
        }
        return 0;
    }

    //
    public function getRegistrations()
    {
        $this->RegistrationDb();
        $query = " SELECT * 
                        FROM registration r
                            INNER JOIN user u ON r.regi_user_id = u.user_id
                            INNER JOIN student s ON s.stud_id = r.regi_stud_id
                            INNER JOIN course c ON c.cour_id = r.regi_cour_id 
                        ORDER BY c.cour_date_start ";
        return $this->_baseDb->getQuery($query);
    }

    //
    public function checkRegistrationToken($tokenId)
    {
        $this->RegistrationDb();
        $query = " SELECT * FROM registration WHERE regi_token = ? ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($tokenId));
        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            return true;
        }
        return false;
    }

    //
    public function checkRegistration($courseId, $studentId)
    {
        $this->RegistrationDb();
        $query = " SELECT * 
                        FROM registration
                        WHERE regi_stud_id = ?
                            AND regi_cour_id  = ?  ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($studentId, $courseId));
        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            return true;
        }

        return false;
    }

    //
    public function getRegistration($tokenId)
    {
        $this->RegistrationDb();
        $query = " SELECT * 
                        FROM registration r
                            INNER JOIN user u ON r.regi_user_id = u.user_id
                            INNER JOIN student s ON s.stud_id = r.regi_stud_id
                            INNER JOIN course c ON c.cour_id = r.regi_cour_id 
                        WHERE r.regi_token = ? ";
        $result = $this->_baseDb->prepare($query);
        $result->execute(array($tokenId));
        if ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $this->_reply['registration'] = $row;
            $this->_reply['msg'] = "";
            $this->_reply['status'] = "true";
        }
        else
        {
            $this->_reply['msg'] = "Esta matricula nao existe";
            $this->_reply['status'] = "false";
        }
        return $this->_reply;
    }
}