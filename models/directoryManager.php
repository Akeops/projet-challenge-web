<?php
require_once __DIR__ . '/../config/database.php';

class DirectoryManager
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->dbConnect();
    }

    function getUsersSkillsForDirectory() {
        $showInDirectoryValue = 1;
     
        $stmt = $this->db->prepare('SELECT USERS.id, PROFILE.name, PROFILE.contactInfo, PROFILE.description, SKILL.name AS skillName
            FROM USERS
                INNER JOIN PROFILE ON USERS.id = PROFILE.userId
                INNER JOIN PROFILE_SKILL ON PROFILE.id = PROFILE_SKILL.profileId
                INNER JOIN SKILL ON PROFILE_SKILL.skillId = SKILL.id
            WHERE PROFILE.showInDirectory = :showInDirectory');
     
        $stmt->bindParam(':showInDirectory', $showInDirectoryValue, PDO::PARAM_INT);
        $stmt->execute();
     
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}