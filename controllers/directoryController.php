<?php
 
require_once './models/directoryManager.php';
require_once './config/database.php';
 
$directoryManager = new DirectoryManager();
 
$getUsersAndSkills = $directoryManager->getUsersSkillsForDirectory();
 
$users = [];
foreach ($getUsersAndSkills as $userSkill) {
    $userId = $userSkill['id'] ?? '';
 
    if (!isset($users[$userId])) {
        $users[$userId] = [
            'userId' => $userId,
            'name' => $userSkill['name'] ?? '',
            'contactInfo' => $userSkill['contactInfo'] ?? '',
            'description' => $userSkill['description'] ?? '',
            'skills' => []
        ];
    }
 
    if (!empty($userSkill['skillName'])) {
        $users[$userId]['skills'][] = $userSkill['skillName'];
    }
}
 
foreach ($users as $userId => $userData) {
    $name = $userData['name'];
    $contactInfo = $userData['contactInfo'];
    $description = $userData['description'];
    $userSkills = $userData['skills'];
 
    // Traitement pour chaque utilisateur
    // ...
}


ob_start();
include './views/pages/directory.php';
$content = ob_get_clean();

include './views/layout.php';