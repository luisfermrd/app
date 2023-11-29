<?php
require_once 'models/TestModel.php';

class TestDAO
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createTest($punctuation, $scorePerQuestion, $description, $studentID)
    {
        $TestModel = new TestModel($this->db);
        return $TestModel->createTest($punctuation, $scorePerQuestion, $description, $studentID);
    }

    public function readTests($studentID)
    {
        $TestModel = new TestModel($this->db);
        return $TestModel->readTests($studentID);
    }
    public function readTestById($TestID, $studentID)
    {
        $TestModel = new TestModel($this->db);
        return $TestModel->readTestById($TestID, $studentID);
    }

    public function updateTest($TestID, $punctuation, $scorePerQuestion, $description, $studentID)
    {
        $TestModel = new TestModel($this->db);
        return $TestModel->updateTest($TestID, $punctuation, $scorePerQuestion, $description, $studentID);
    }

    public function deleteTest($TestID)
    {
        $TestModel = new TestModel($this->db);
        return $TestModel->deleteTest($TestID);
    }
}
