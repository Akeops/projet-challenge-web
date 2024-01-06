<?php

$availableRoutes = [
    'home' => 'homeController.php',
    'register' => 'registerController.php',
    'login' => 'loginController.php',
    'logout' => 'logoutController.php',
    'forum' => 'forumController.php',
    'directory' => 'directoryController.php'
];

if (isset($_SESSION['id'])) {
    $availableRoutes['profile'] = 'profileController.php';
}

$defaultRoute = $availableRoutes['home'];
