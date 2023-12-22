<?php
require_once './config/database.php';

class UsersManager {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->dbConnect();
    }

    public function registerUser($username, $password, $email) {
        if ($this->isUserExists($username, $email)) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare('INSERT INTO users (username, password, email, registrationDate) VALUES (:username, :password, :email, NOW())');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    private function isUserExists($username, $email) {
        $stmt = $this->db->prepare('SELECT id FROM users WHERE username = :username OR email = :email');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) != false;
    }

    function getUserByEmail($email) {
        $stmt = $this->db->prepare('SELECT id, username, email, password FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        return $userData;
    }  
}
