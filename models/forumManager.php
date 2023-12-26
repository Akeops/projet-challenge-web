<?php
require_once './config/database.php';

class ForumManager
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->dbConnect();
    }



    // LOGIQUE ICI


}