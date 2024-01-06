<?php
require_once './config/database.php';
require_once 'rolesManager.php';

class UsersManager
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->dbConnect();
    }

    public function registerUser($username, $password, $email): bool
    {
        if ($this->isUserExists($username, $email)) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare('INSERT INTO users (username, password, email, registrationDate) VALUES (:username, :password, :email, NOW())');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            $userId = $this->db->lastInsertId();

            $rolesManager = new RolesManager();
            $rolesManager->setRole($userId, 'standard');

            return true;
        } else {
            return false;
        }
    }

    private function isUserExists($username, $email): bool
    {
        $stmt = $this->db->prepare('SELECT id FROM users WHERE username = :username OR email = :email');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) != false;
    }

    function getUserByEmail($email)
    {
        $stmt = $this->db->prepare('SELECT id, username, email, password FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteUser($userId): bool
    {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare('DELETE FROM likes WHERE userId = :userId');
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            $stmt = $this->db->prepare('DELETE FROM comment WHERE userId = :userId');
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            $stmt = $this->db->prepare('DELETE FROM participation WHERE userId = :userId');
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            $stmt = $this->db->prepare('DELETE FROM profile WHERE userId = :userId');
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            $stmt = $this->db->prepare('DELETE FROM users WHERE id = :userId');
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
