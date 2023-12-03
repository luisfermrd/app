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

    public function readStudents($userID)
    {
        $sql = "SELECT
                    UG.GroupName,
                    US.StudentID,
                    US.UserName,
                    US.Gender,
                    YEAR(CURDATE()) - YEAR(US.BirthDate) - (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(US.BirthDate, '%m%d')) AS Age
                FROM User_Students US
                LEFT JOIN User_Groups UG ON US.GroupID = UG.GroupID
                WHERE US.UserID = :userID
                ORDER BY UG.GroupName ASC, US.GroupID IS NULL, Age;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readStudentById($studentID)
    {
        $sql = "SELECT * FROM User_Students WHERE StudentID = :studentID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('studentID', $studentID);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readStudentByUserName($userName)
    {
        $sql = "SELECT * FROM User_Students WHERE UserName = :userName";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('userName', $userName);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStudent($studentID, $userName, $birthDate, $gender, $password, $userID, $groupID)
    {
        if ($password != '') {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE User_Students SET UserName = :userName, BirthDate = :birthDate, Gender = :gender, Password = :password, UserID = :userID, GroupID = :groupID WHERE StudentID = :studentID";
        }else{
            $sql = "UPDATE User_Students SET UserName = :userName, BirthDate = :birthDate, Gender = :gender, UserID = :userID, GroupID = :groupID WHERE StudentID = :studentID";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':studentID', $studentID);
        $stmt->bindParam(':userName', $userName);
        $stmt->bindParam(':birthDate', $birthDate);
        $stmt->bindParam(':gender', $gender);
        if ($password != '') {
            $stmt->bindParam(':password', $hashedPassword);
        }
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

    public function validateEstudent($userName, $password)
    {
        // Validación de datos
        if (empty($userName) || empty($password)) {
            return false;
        }

        $sql = "SELECT * FROM User_Students WHERE UserName = :userName";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userName', $userName);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Password'])) {
            return $user;
        } else {
            return false;
        }
    }
}
