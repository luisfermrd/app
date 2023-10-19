<?php
class UserModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createUser($userName, $email, $password, $institution)
    {
        // Validación de datos
        if (empty($userName) || empty($email) || empty($password) || empty($institution)) {
            return NULL;
        }

        // Encriptar la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Inserción en la base de datos
        $sql = "INSERT INTO Users (UserName, Email, Password, Institution) VALUES (:userName, :email, :password, :institution)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userName', $userName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':institution', $institution);

        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        } else {
            return NULL;
        }
    }
    public function createVerification($UserId, $userName, $Code)
    {
        // Validación de datos
        if (empty($UserId) || empty($userName) || empty($Code)) {
            return false;
        }

        // Inserción en la base de datos
        $sql = "INSERT INTO Verification (UserId, UserName, Code) VALUES (:userId, :userName, :code)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userId', $UserId);
        $stmt->bindParam(':userName', $userName);
        $stmt->bindParam(':code', $Code);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function confirmVerification($UserId, $Code)
    {
        // Validación de datos
        if (empty($UserId) || empty($Code)) {
            return NULL;
        }

        // Verificar si hay una coincidencia en Verification
        $sql = "SELECT Users.UserID, Users.UserName
            FROM Users
            INNER JOIN Verification ON Users.UserID = Verification.UserID
            WHERE Users.UserID = :userId AND Verification.Code = :code;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userId', $UserId);
        $stmt->bindParam(':code', $Code);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Actualizar IsVerified en Users
            $updateSql = "UPDATE Users
                      SET IsVerified = 1
                      WHERE UserID = :userId;";
            $updateStmt = $this->db->prepare($updateSql);
            $updateStmt->bindParam(':userId', $UserId);

            if ($updateStmt->execute()) {
                // Eliminar el registro de Verification
                $deleteSql = "DELETE FROM Verification WHERE UserID = :userId;";
                $deleteStmt = $this->db->prepare($deleteSql);
                $deleteStmt->bindParam(':userId', $UserId);
                $deleteStmt->execute();

                return $result['UserName'];
            }
        }
        return NULL;
    }


    public function validateEmail($email)
    {
        // Validación de datos
        if (empty($email)) {
            return false;
        }
        // Buscar al usuario por email
        $sql = "SELECT * FROM Users WHERE Email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return $user;
        } else {
            return false;
        }
    }
    public function validateUser($email, $password)
    {
        // Validación de datos
        if (empty($email) || empty($password)) {
            return false;
        }
        // Buscar al usuario por email
        $sql = "SELECT * FROM Users WHERE Email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Password'])) {
            return $user;
        } else {
            return false;
        }
    }
}
