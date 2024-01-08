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

$searchTerm = htmlspecialchars($_GET['search'] ?? '');
$uniqueUsers = [];

function groupUserSkills($users): array
{
    $groupedUsers = [];

    foreach ($users as $user) {
        $userId = $user['id'] ?? $user['userId'];

        if (!array_key_exists($userId, $groupedUsers)) {
            $groupedUsers[$userId] = [
                'userId' => $userId,
                'name' => $user['name'] ?? $user['username'],
                'contactInfo' => $user['contactInfo'] ?? '',
                'description' => $user['description'] ?? '',
                'role' => $user['role'] ?? '',
                'skills' => []
            ];
        }

        if (!empty($user['skillName']) && !in_array($user['skillName'], $groupedUsers[$userId]['skills'])) {
            $groupedUsers[$userId]['skills'][] = $user['skillName'];
        }
    }

    return $groupedUsers;
}

if (!empty($searchTerm)) {
    $users = $directoryManager->searchUsers($userRole, $searchTerm);
} else {
    $users = ($userRole === 'admin') ? $directoryManager->getAllUsersForDirectory() : $directoryManager->getUsersSkillsForDirectory();
}

$uniqueUsers = groupUserSkills($users);

if ($userRole === 'admin' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['deleteUser'])) {
        $usersManager->deleteUser($_GET['userId']);
        header("Location: index.php?page=directory");
        exit;
    }
    if (isset($_GET['grantModo'])) {
        $rolesManager->grantModo($_GET['userId']);
        header("Location: index.php?page=directory");
        exit;
    }
    if (isset($_GET['downgradeToStandard'])) {
        $rolesManager->downgradeToStandard($_GET['userId']);
        header("Location: index.php?page=directory");
        exit;
    }
}

$usersPerPage = 5;
$totalUsers = count($uniqueUsers);
$totalPages = ceil($totalUsers / $usersPerPage);

$currentPage = isset($_GET['nbpage']) ? (int)$_GET['nbpage'] : 1;
$currentPage = max($currentPage, 1);
$currentPage = min($currentPage, $totalPages);

$displayUsers = array_slice($uniqueUsers, ($currentPage - 1) * $usersPerPage, $usersPerPage, true);

$maxPagesToShow = 15;
$startPage = max(1, $currentPage - floor($maxPagesToShow / 2));
$endPage = min($totalPages, $startPage + $maxPagesToShow - 1);
$startPage = max(1, min($startPage, $totalPages - $maxPagesToShow + 1));

ob_start();
include './views/pages/directory.php';
$content = ob_get_clean();

include './views/layout.php';