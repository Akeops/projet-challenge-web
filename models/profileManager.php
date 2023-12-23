<?php
require_once './config/database.php';

class ProfileManager
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->dbConnect();
    }

    public function createProfile($userId)
    {
        $stmt = $this->db->prepare("INSERT INTO PROFILE (userId) VALUES (?)");
        $stmt->execute([$userId]);
        return $this->db->lastInsertId();
    }

    public function getProfile($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM PROFILE WHERE userId = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile($userId, $name, $contactInfo, $description, $showInDirectory)
    {
        $stmt = $this->db->prepare("UPDATE PROFILE SET name = ?, contactInfo = ?, description = ?, showInDirectory = ? WHERE userId = ?");
        $stmt->execute([$name, $contactInfo, $description, $showInDirectory, $userId]);
    }

    public function getSkills()
    {
        $stmt = $this->db->query("SELECT * FROM SKILL");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProfileSkills($profileId)
    {
        $stmt = $this->db->prepare("SELECT skillId FROM PROFILE_SKILL WHERE profileId = ?");
        $stmt->execute([$profileId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    public function updateProfileSkills($profileId, $skillIds)
    {
        $this->db->beginTransaction();
        $this->db->exec("DELETE FROM PROFILE_SKILL WHERE profileId = $profileId");
        $stmt = $this->db->prepare("INSERT INTO PROFILE_SKILL (profileId, skillId) VALUES (?, ?)");
        foreach ($skillIds as $skillId) {
            $stmt->execute([$profileId, $skillId]);
        }
        $this->db->commit();
    }
}