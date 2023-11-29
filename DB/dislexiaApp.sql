CREATE DATABASE IF NOT EXISTS dislexiaApp;
use dislexiaApp;

-- Create the Users table
CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    UserName VARCHAR(40) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Institution VARCHAR(60),
    IsActive TINYINT NOT NULL DEFAULT 1,
    IsVerified TINYINT NOT NULL DEFAULT 0,
    RegistrationDateTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the Verification table
CREATE TABLE Verification(
  UserID INT NOT NULL,
  UserName VARCHAR(40) NOT NULL,
  Code VARCHAR(250) NOT NULL,
  FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE
);

-- Create the Groups table
CREATE TABLE User_Groups (
    GroupID INT AUTO_INCREMENT PRIMARY KEY,
    GroupName VARCHAR(255) NOT NULL,
    Description TEXT NOT NULL,
    UserID INT NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE
);

-- Create the Students table
CREATE TABLE User_Students (
    StudentID INT AUTO_INCREMENT PRIMARY KEY,
    UserName VARCHAR(255) NOT NULL,
    BirthDate DATE,
    Gender ENUM('Masculino', 'Femenino','Prefiero no decirlo', 'Otro'),
    Password VARCHAR(255) NOT NULL,
    UserID INT,
    GroupID INT,
    FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE,
    FOREIGN KEY (GroupID) REFERENCES User_Groups(GroupID) ON DELETE CASCADE
);

CREATE TABLE Students_Tests (
    TestID INT AUTO_INCREMENT PRIMARY KEY,
    Punctuation VARCHAR(10) NOT NULL,
    ScorePerQuestion TEXT NOT NULL,
    Description TEXT NOT NULL,
    StudentID INT NOT NULL,
    FOREIGN KEY (StudentID) REFERENCES User_Students(StudentID) ON DELETE CASCADE
);







--TRIGGERS
DELIMITER $$
CREATE TRIGGER Before_Delete_Group
BEFORE DELETE ON User_Groups
FOR EACH ROW
BEGIN
    -- Actualiza el GroupID de los estudiantes asociados a NULL
    UPDATE User_Students
    SET GroupID = NULL
    WHERE GroupID = OLD.GroupID;
END;
$$
DELIMITER ;



