<?php

// Inclure votre fonction dbConnect
require_once './config/database.php';
require_once './models/usersManager.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = isset($_POST['id']) ? $_POST['id'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $userExists = $this->getUserByEmail($email);

    if (password_verify($password, $userExists['hashed_password']) && $userExists['email'] == $email) { 
        $session_start();
        $SESSION['id'] = $userId; 
    } 
} else {
       echo "L'utilisateur n'existe pas. Vous pouvez procéder à l'inscription.";
}

    $db = null;

// Afficher le formulaire de connexion
include('./views/pages/login.php');
?>