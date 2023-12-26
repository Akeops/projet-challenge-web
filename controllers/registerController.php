<?php

require_once './models/usersManager.php';
require_once './config/database.php';

$userManager = new UsersManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';

    $registrationSuccess = $userManager->registerUser($username, $password, $email);

    if ($registrationSuccess) {
        header('Location: index.php?page=login');
        exit();
    } else {
        $_SESSION['error'] = "Erreur d'inscription, recommencez.";
    }
}

ob_start();
include './views/pages/register.php';
$content = ob_get_clean();

include './views/layout.php';