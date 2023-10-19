<?php
require_once 'models/UserModel.php';

class UserDAO
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createUser($userName, $email, $password, $institution)
    {
        // Implementa validaciones y llamadas al modelo.
        $userModel = new UserModel($this->db);

        return $userModel->createUser($userName, $email, $password, $institution);
    }
    public function createVerification($UserId, $userName, $Code)
    {
        // Implementa validaciones y llamadas al modelo.
        $userModel = new UserModel($this->db);

        return $userModel->createVerification($UserId, $userName, $Code);
    }
    public function confirmVerification($UserId, $Code)
    {
        // Implementa validaciones y llamadas al modelo.
        $userModel = new UserModel($this->db);

        return $userModel->confirmVerification($UserId, $Code);
    }

    public function validateEmail($email)
    {
        // Implementa la lógica de inicio de sesión y llama al modelo.
        $userModel = new UserModel($this->db);

        return $userModel->validateEmail($email);
    }
    public function login($email, $password)
    {
        // Implementa la lógica de inicio de sesión y llama al modelo.
        $userModel = new UserModel($this->db);

        return $userModel->validateUser($email, $password);
    }
}
