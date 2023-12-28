<?php

require_once './models/directoryManager.php';
require_once './config/database.php';

$directoryManager = new DirectoryManager();

$getUsersByShowInDirectory = $directoryManager->getUsersByShowInDirectory();



    foreach ($getUsersByShowInDirectory as $user) {
        $userId = $user['userId'] ?? '';
        $name = $user['name'] ?? '';
        $contactInfo = $user['contactInfo'] ?? '';
        $description = $user['description'] ?? '';
        
        $userSkills = $directoryManager->getSkillsByUsersId($userId);


        // Afficher les compétences
        
    }


ob_start();
include './views/pages/directory.php';
$content = ob_get_clean();

include './views/layout.php';