<?php

require_once './models/profileManager.php';
require_once './config/database.php';

$profileManager = new ProfileManager();
$userId = $_SESSION['id'];

$profile = $profileManager->getProfile($userId);
if (!$profile) {
    $profileId = $profileManager->createProfile($userId);
    $profile = $profileManager->getProfile($userId);
} else {
    $profileId = $profile['id'];
}

if (!$profile) {
    $profile = [
        'name' => '',
        'contactInfo' => '',
        'description' => '',
        'showInDirectory' => false
    ];
} else {
    $selectedSkills = $profileManager->getProfileSkills($profile['id']);
}
$selectedSkills = isset($selectedSkills) ? $selectedSkills : [];
$skills = $profileManager->getSkills();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $contactInfo = $_POST['contactInfo'];
    $description = $_POST['description'];
    $showInDirectory = isset($_POST['showInDirectory']) ? 1 : 0;
    $skillIds = isset($_POST['skills']) ? $_POST['skills'] : [];
    if (count($skillIds) > 2) {
        $_SESSION['error'] = "Veuillez sélectionner au maximum deux compétences.";
    } else {
        $profileManager->updateProfileSkills($profile['id'], $skillIds);
    }

    $profileManager->updateProfile($userId, $name, $contactInfo, $description, $showInDirectory);

    header('Location: index.php?page=profile');
    exit();
}

ob_start();
include './views/pages/profile.php';
$content = ob_get_clean();

include './views/layout.php';