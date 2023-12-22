<?php
require_once './models/usersManager.php';
require_once './config/database.php';

$userManager = new UsersManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    $registrationSuccess = $userManager->registerUser($username, $password, $email);

    if ($registrationSuccess) {
        header('Location: index.php?page=login');
        exit();
    } else {
        echo "Erreur d'inscription";
    }
}

ob_start();
include './views/pages/register.php';
$content = ob_get_clean();

include './views/layout.php';
