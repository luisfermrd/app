<?php
require_once 'dao/StudentDAO.php';
class StudentController
{
    private $studentDAO;
    private $userID;

    public function __construct($db)
    {
        $this->studentDAO = new StudentDAO($db);
        session_start();
        $this->userID = $_SESSION['user_id'];
    }

    public function createStudent()
    {
        // Validar datos recibidos por $_POST
        $userName = $_POST['userName'];
        $birthDate = $_POST['birthDate'];
        $gender = $_POST['gender'];
        $password = $_POST['password'];
        $groupID = $_POST['groupID'] == '' ? NULL : $_POST['groupID'];

        $result = $this->studentDAO->createStudent($userName, $birthDate, $gender, $password, $this->userID, $groupID);

        if ($result) {
            return ['status' => 'success', 'message' => 'Estudiante creado con éxito'];
        } else {
            return ['status' => 'error', 'message' => 'Error al crear el estudiante'];
        }
    }

    public function readStudents()
    {

        $students = $this->studentDAO->readStudents();

        return ['status' => 'success', 'data' => $students];
    }

    public function updateStudent()
    {
        // Validar datos recibidos por $_POST
        $studentID = $_POST['studentID'];
        $userName = $_POST['userName'];
        $birthDate = $_POST['birthDate'];
        $gender = $_POST['gender'];
        $password = $_POST['password'];
        $groupID = $_POST['groupID'];


        $result = $this->studentDAO->updateStudent($studentID, $userName, $birthDate, $gender, $password, $this->userID, $groupID);

        if ($result) {
            return ['status' => 'success', 'message' => 'Estudiante actualizado con éxito'];
        } else {
            return ['status' => 'error', 'message' => 'Error al actualizar el estudiante'];
        }
    }

    public function deleteStudent()
    {
        // Validar datos recibidos por $_POST
        $studentID = $_POST['studentID'];

        $result = $this->studentDAO->deleteStudent($studentID);

        if ($result) {
            return ['status' => 'success', 'message' => 'Estudiante eliminado con éxito'];
        } else {
            return ['status' => 'error', 'message' => 'Error al eliminar el estudiante'];
        }
    }
}
