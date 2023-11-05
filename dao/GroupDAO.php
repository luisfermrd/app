<?php
require_once 'models/GroupModel.php';

class GroupDAO
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createGroup($name, $description, $userID)
    {
        $groupModel = new GroupModel($this->db);
        return $groupModel->createGroup($name, $description, $userID);
    }

    public function readGroups($userID)
    {
        $groupModel = new GroupModel($this->db);
        return $groupModel->readGroups($userID);
    }
    public function readGroupById($groupID, $userID)
    {
        $groupModel = new GroupModel($this->db);
        return $groupModel->readGroupById($groupID, $userID);
    }

    public function updateGroup($groupID, $name, $description, $userID)
    {
        $groupModel = new GroupModel($this->db);
        return $groupModel->updateGroup($groupID, $name, $description, $userID);
    }

    public function deleteGroup($groupID)
    {
        $groupModel = new GroupModel($this->db);
        return $groupModel->deleteGroup($groupID);
    }
}
