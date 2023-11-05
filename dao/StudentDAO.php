<?php
require_once 'models/StudentModel.php';
class StudentDAO
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createStudent($userName, $birthDate, $gender, $password, $userID, $groupID)
    {
        $studentModel = new StudentModel($this->db);
        return $studentModel->createStudent($userName, $birthDate, $gender, $password, $userID, $groupID);
    }

    public function readStudents($userID)
    {
        $studentModel = new StudentModel($this->db);
        return $studentModel->readStudents($userID);
    }

    public function readStudentById($userID)
    {
        $studentModel = new StudentModel($this->db);
        return $studentModel->readStudentById($userID);
    
    }
    public function readStudentByUserName($userName)
    {
        $studentModel = new StudentModel($this->db);
        return $studentModel->readStudentByUserName($userName);
    }

    public function updateStudent($studentID, $userName, $birthDate, $gender, $password, $userID, $groupID)
    {
        $studentModel = new StudentModel($this->db);
        return $studentModel->updateStudent($studentID, $userName, $birthDate, $gender, $password, $userID, $groupID);
    }

    public function deleteStudent($studentID)
    {
        $studentModel = new StudentModel($this->db);
        return $studentModel->deleteStudent($studentID);
    }
}
