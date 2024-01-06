<?php

require_once './models/directoryManager.php';
require_once './models/rolesManager.php';
require_once './models/usersManager.php';
require_once './config/database.php';

$directoryManager = new DirectoryManager();
$rolesManager = new RolesManager();
$usersManager = new UsersManager();

$userIdRole = $_SESSION['id'] ?? null;
$userRole = $userIdRole ? $rolesManager->getRole($userIdRole)['name'] : null;

$getUsersAndSkills = $directoryManager->getUsersSkillsForDirectory();

$users = [];

if ($userRole === 'standard' || $userRole === 'modo') {
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
}

if ($userRole === 'admin') {
    $getAllUsers = $directoryManager->getAllUsersForDirectory();

    $usersAll = [];

    foreach ($getAllUsers as $userAll) {
        $userAllId = $userAll['id'] ?? '';
        $userAllUsername = $userAll['username'] ?? '';
        $userAllActRole = $rolesManager->getRole($userAllId)['name'] ?? '';

        if (!isset($usersAll[$userAllId])) {
            $usersAll[$userAllId] = [
                'userId' => $userAllId,
                'role' => $userAllActRole,
                'username' => $userAllUsername,
            ];
        }
    }
}

if ($userRole === 'admin') {
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['deleteUser'])) {
        $usersManager->deleteUser($_GET['userId']);
        header("Location: index.php?page=directory");
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['grantModo'])) {
        $rolesManager->grantModo($_GET['userId']);
        header("Location: index.php?page=directory");
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['downgradeToStandard'])) {
        $rolesManager->downgradeToStandard($_GET['userId']);
        header("Location: index.php?page=directory");
        exit;
    }
}

ob_start();
include './views/pages/directory.php';
$content = ob_get_clean();

include './views/layout.php';