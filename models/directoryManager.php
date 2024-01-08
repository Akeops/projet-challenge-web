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

    function getUsersSkillsForDirectory()
    {
        $showInDirectoryValue = 1;

        $stmt = $this->db->prepare('SELECT USERS.id, PROFILE.name, PROFILE.contactInfo, PROFILE.description, SKILL.name AS skillName
        FROM USERS
            INNER JOIN PROFILE ON USERS.id = PROFILE.userId
            LEFT JOIN PROFILE_SKILL ON PROFILE.id = PROFILE_SKILL.profileId
            LEFT JOIN SKILL ON PROFILE_SKILL.skillId = SKILL.id
        WHERE PROFILE.showInDirectory = :showInDirectory');

        $stmt->bindParam(':showInDirectory', $showInDirectoryValue, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getAllUsersForDirectory()
    {

        $stmt = $this->db->prepare('SELECT USERS.id AS userId, USERS.username, ROLE.name AS role
                        FROM USERS
                        INNER JOIN ROLE ON USERS.roleId = ROLE.id  ORDER BY registrationDate');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function searchUsers($role, $searchTerm)
    {

        if ($role === 'admin') {
            $stmt = $this->db->prepare(
                'SELECT USERS.id AS userId, USERS.username, ROLE.name AS role
                        FROM USERS
                        INNER JOIN ROLE ON USERS.roleId = ROLE.id 
                        WHERE ROLE.name LIKE :searchTerm OR USERS.id LIKE :searchTerm'
            );
        } else {
            $stmt = $this->db->prepare('SELECT USERS.id, PROFILE.name AS name, PROFILE.contactInfo, PROFILE.description, SKILL.name AS skillName 
            FROM USERS 
            INNER JOIN PROFILE ON USERS.id = PROFILE.userId 
            INNER JOIN PROFILE_SKILL ON PROFILE.id = PROFILE_SKILL.profileId 
            INNER JOIN SKILL ON PROFILE_SKILL.skillId = SKILL.id 
            WHERE (PROFILE.name LIKE :searchTerm OR SKILL.name LIKE :searchTerm)
            AND PROFILE.showInDirectory = 1');
        }

        $searchTerm = "%$searchTerm%";
        $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}