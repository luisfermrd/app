<?php
require_once 'dao/TestDAO.php';

class TestController
{
    private $TestDAO;

    public function __construct($db)
    {
        $this->TestDAO = new TestDAO($db);
    }

    public function createTest()
    {
        // Validar datos recibidos por $_POST
        $punctuation = $_POST['punctuation'];
        $scorePerQuestion = $_POST['scorePerQuestion'];
        $description = $_POST['description'];
        $studentID = $_POST['studentID'];

        $test = $this->TestDAO->readTests($studentID);

        if($test){
            $result = $this->TestDAO->updateTest($test[0]['TestID'], $punctuation, $scorePerQuestion, $description, $studentID);
        }else{
            $result = $this->TestDAO->createTest($punctuation, $scorePerQuestion, $description, $studentID);
        }
        


        if ($result) {
            return ['status' => 'success', 'message' => 'Test registrado con éxito'];
        } else {
            return ['status' => 'error', 'message' => 'Error al registrar el test'];
        }
    }

    public function readTests()
    {
        
        $studentID = $_POST['studentID'];

        $Tests = $this->TestDAO->readTests($studentID);

        return ['status' => 'success', 'data' => $Tests];
    }

    public function readTestById()
    {
        
        $studentID = $_POST['studentID'];
        $TestID = $_POST['TestID'];

        $result = $this->TestDAO->readTestById($TestID, $studentID);

        if ($result) {
            return ['status' => 'success', 'data' => $result[0]];
        }else{
            return ['status' => 'error', 'message' => 'test no encontrado'];
        }

    }

    public function updateTest()
    {
        // Validar datos recibidos por $_POST
        $punctuation = $_POST['punctuation'];
        $scorePerQuestion = $_POST['scorePerQuestion'];
        $description = $_POST['description'];
        $studentID = $_POST['studentID'];
        $TestID = $_POST['testID'];

        $result = $this->TestDAO->updateTest($TestID, $punctuation, $scorePerQuestion, $description, $studentID);

        if ($result) {
            return ['status' => 'success', 'message' => 'test actualizado con éxito'];
        } else {
            return ['status' => 'error', 'message' => 'Error al actualizar el test'];
        }
    }

    public function deleteTest()
    {
        // Validar datos recibidos por $_POST
        $TestID = $_POST['TestID'];

        $result = $this->TestDAO->deleteTest($TestID);

        if ($result) {
            return ['status' => 'success', 'message' => 'test eliminado con éxito'];
        } else {
            return ['status' => 'error', 'message' => 'Error al eliminar el test'];
        }
    }
}
