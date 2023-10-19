<?php
class GroupModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createGroup($name, $description, $userID)
    {
        $sql = "INSERT INTO User_Groups (GroupName, Description, UserID) VALUES (:name, :description, :userID)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':userID', $userID);

        return $stmt->execute();
    }

    public function readGroups($userID)
    {
        $sql = "SELECT * FROM User_Groups WHERE UserID = :UserID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':UserID', $userID);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateGroup($groupID, $name, $description, $userID)
    {
        $sql = "UPDATE User_Groups SET GroupName = :name, Description = :description, UserID = :userID WHERE GroupID = :groupID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':groupID', $groupID);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':userID', $userID);

        return $stmt->execute();
    }

    public function deleteGroup($groupID)
    {
        $sql = "DELETE FROM User_Groups WHERE GroupID = :groupID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':groupID', $groupID);

        return $stmt->execute();
    }
}
