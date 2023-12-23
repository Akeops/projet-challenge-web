<?php

require_once './config/database.php';
require_once './models/usersManager.php';

$userManager = new UsersManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $user = $userManager->getUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['id'];
        header('Location: index.php?page=home');
        exit();
    } else {
        $_SESSION['error'] = "L'utilisateur n'existe pas. Vous pouvez procéder à l'inscription.";
    }
}

$db = null;

ob_start();
include('./views/pages/login.php');
$content = ob_get_clean();

include './views/layout.php';