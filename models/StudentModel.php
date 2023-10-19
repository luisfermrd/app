<?php
class StudentModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createStudent($userName, $birthDate, $gender, $password, $userID, $groupID)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO User_Students (UserName, BirthDate, Gender, Password, UserID, GroupID) VALUES (:userName, :birthDate, :gender, :password, :userID, :groupID)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userName', $userName);
        $stmt->bindParam(':birthDate', $birthDate);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':groupID', $groupID);

        return $stmt->execute();
    }

    public function readStudents()
    {
        $sql = "SELECT * FROM User_Students";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStudent($studentID, $userName, $birthDate, $gender, $password, $userID, $groupID)
    {
        $sql = "UPDATE User_Students SET UserName = :userName, BirthDate = :birthDate, Gender = :gender, Password = :password, UserID = :userID, GroupID = :groupID WHERE StudentID = :studentID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':studentID', $studentID);
        $stmt->bindParam(':userName', $userName);
        $stmt->bindParam(':birthDate', $birthDate);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':groupID', $groupID);

        return $stmt->execute();
    }

    public function deleteStudent($studentID)
    {
        $sql = "DELETE FROM User_Students WHERE StudentID = :studentID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':studentID', $studentID);

        return $stmt->execute();
    }
}
