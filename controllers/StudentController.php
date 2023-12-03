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
        $this->userID = isset($_SESSION['user_id'])? $_SESSION['user_id']:NULL;
    }

    public function createStudent()
    {
        // Validar datos recibidos por $_POST
        $userName = $_POST['userName'];
        if ($this->studentDAO->readStudentByUserName($userName)) {
            return ['status' => 'error', 'message' => 'Ya existe un estudiante con este nombre de usuario, por favor intente con otro!'];
        }
        
        $birthDate = $_POST['birthDate'];
        $birthdate = new DateTime($birthDate);
        $currentDate = new DateTime();
        $age = $birthdate->diff($currentDate)->y;
        if ($age < 10) {
            return ['status' => 'error', 'message' => 'El estudiante debe tener como minimo 10 años, verifique la fecha de nacimiento'];
        } 
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

        $students = $this->studentDAO->readStudents($this->userID);

        return ['status' => 'success', 'data' => $students];
    }
    public function readStudentById()
    {

        $studentID = $_POST['studentID'];

        $student = $this->studentDAO->readStudentById($studentID);

        if ($student) {
            return ['status' => 'success', 'data' => $student[0]];
        } else {
            return ['status' => 'error', 'message' => 'El id proporsionado nos e encuentra registrado'];
        }
    }

    public function updateStudent()
    {
        // Validar datos recibidos por $_POST
        $studentID = $_POST['studentID'];
        $userName = $_POST['userName'];
        $birthDate = $_POST['birthDate'];
        $gender = $_POST['gender'];
        $password = $_POST['password'];
        $groupID = $_POST['groupID'] == '' ? NULL : $_POST['groupID'];


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

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = isset($_POST['user']) ? $_POST['user'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            // Validaciones de datos
            if (empty($user) || empty($password)) {
                $response = ['status' => 'error', 'message' => 'Debes proporcionar un correo y una contraseña.'];
                return $response;
            }

            // Inicio de sesión
            $user = $this->studentDAO->login($user, $password);

            if ($user) {
                $_SESSION['studentID'] = $user['StudentID'];
                $_SESSION['userName'] = $user['UserName'];

                $response = ['status' => 'success', 'message' => 'Inicio de sesión exitoso.'];
            } else {
                $response = ['status' => 'error', 'message' => 'Credenciales incorrectas.'];
            }

            return $response;
        }
    }
}
