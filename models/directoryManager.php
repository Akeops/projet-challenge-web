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

    function getUsersByShowInDirectory()
    {
        $showInDirectoryValue = 1;

        $stmt = $this->db->prepare('SELECT * FROM profile WHERE showInDirectory = showInDirectory');
        $stmt->bindParam(':showInDirectory', $showInDirectoryValue);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}