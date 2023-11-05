<?php
require_once 'dao/GroupDAO.php';

class GroupController
{
    private $groupDAO;
    private $userID;

    public function __construct($db)
    {
        $this->groupDAO = new GroupDAO($db);
        session_start();
        $this->userID = $_SESSION['user_id'];
    }

    public function createGroup()
    {
        // Validar datos recibidos por $_POST
        $name = $_POST['name'];
        $description = $_POST['description'];
        

        $result = $this->groupDAO->createGroup($name, $description, $this->userID);

        if ($result) {
            return ['status' => 'success', 'message' => 'Grupo creado con éxito'];
        } else {
            return ['status' => 'error', 'message' => 'Error al crear el grupo'];
        }
    }

    public function readGroups()
    {
        $groups = $this->groupDAO->readGroups($this->userID);

        return ['status' => 'success', 'data' => $groups];
    }

    public function readGroupById()
    {
        $groupID = $_POST['groupID'];

        $result = $this->groupDAO->readGroupById($groupID, $this->userID);

        if ($result) {
            return ['status' => 'success', 'data' => $result[0]];
        }else{
            return ['status' => 'error', 'message' => 'Grupo no encontrado'];
        }

    }

    public function updateGroup()
    {
        // Validar datos recibidos por $_POST
        $groupID = $_POST['groupID'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        $result = $this->groupDAO->updateGroup($groupID, $name, $description, $this->userID);

        if ($result) {
            return ['status' => 'success', 'message' => 'Grupo actualizado con éxito'];
        } else {
            return ['status' => 'error', 'message' => 'Error al actualizar el grupo'];
        }
    }

    public function deleteGroup()
    {
        // Validar datos recibidos por $_POST
        $groupID = $_POST['groupID'];

        $result = $this->groupDAO->deleteGroup($groupID);

        if ($result) {
            return ['status' => 'success', 'message' => 'Grupo eliminado con éxito'];
        } else {
            return ['status' => 'error', 'message' => 'Error al eliminar el grupo'];
        }
    }
}
