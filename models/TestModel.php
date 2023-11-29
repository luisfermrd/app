<?php
class TestModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createTest($punctuation, $scorePerQuestion, $description, $StudentID)
    {
        $sql = "INSERT INTO Students_Tests (Punctuation, ScorePerQuestion, Description, StudentID) VALUES (:punctuation, :scorePerQuestion, :description, :studentID)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':punctuation', $punctuation);
        $stmt->bindParam(':scorePerQuestion', $scorePerQuestion);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':studentID', $StudentID);

        return $stmt->execute();
    }

    public function readTests($StudentID)
    {
        $sql = "SELECT * FROM Students_Tests AS st LEFT JOIN User_Students AS us ON st.StudentID = us.StudentID WHERE st.StudentID = :studentID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':studentID', $StudentID);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

    public function readTestById($TestID, $StudentID)
    {
        $sql = "SELECT * FROM Students_Tests WHERE StudentID = :studentID AND TestID = :TestID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':studentID', $StudentID);
        $stmt->bindParam(':TestID', $TestID);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateTest($TestID, $punctuation, $scorePerQuestion, $description, $StudentID)
    {
        $sql = "UPDATE Students_Tests SET Punctuation = :punctuation, ScorePerQuestion = :scorePerQuestion, Description = :description, StudentID = :studentID WHERE TestID = :TestID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':TestID', $TestID);
        $stmt->bindParam(':punctuation', $punctuation);
        $stmt->bindParam(':scorePerQuestion', $scorePerQuestion);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':studentID', $StudentID);

        return $stmt->execute();
    }

    public function deleteTest($TestID)
    {
        $sql = "DELETE FROM Students_Tests WHERE TestID = :TestID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':TestID', $TestID);

        return $stmt->execute();
    }
}
