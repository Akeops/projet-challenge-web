<?php
require_once './config/database.php';

class RolesManager
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->dbConnect();
    }

    public function getRole($userId)
    {
        $sql = "SELECT name FROM ROLE JOIN USERS ON ROLE.id = USERS.roleId WHERE USERS.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setRole($userId, $roleName): bool
    {
        $sql = "UPDATE USERS SET roleId = (SELECT id FROM ROLE WHERE name = ?) WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$roleName, $userId]);
    }

    public function grantModo($userId): bool
    {
        $sql = "UPDATE USERS SET roleId = (SELECT id FROM ROLE WHERE name = 'modo') WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$userId]);
    }

    public function downgradeToStandard($userId): bool
    {
        $sql = "UPDATE USERS SET roleId = (SELECT id FROM ROLE WHERE name = 'standard') WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$userId]);
    }
}
