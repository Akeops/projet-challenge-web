<?php

// Inclure votre fonction dbConnect
require_once('./config/database.php');

// Récupération des paramètres POST
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Vérifier si les données POST ont été soumises
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valider les données (vous devrez peut-être ajouter davantage de validations)

    // Créer une instance de la classe de connexion
    $db = dbConnect(); // Utilisez votre fonction dbConnect

    // Vérifier l'authentification
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Vérifier le résultat de la requête
    if ($stmt->rowCount() > 0) {
        // Authentification réussie, rediriger ou effectuer d'autres actions nécessaires
        header("Location: home.php");
        exit();
    } else {
        // Authentification échouée, afficher un message d'erreur par exemple
        $messageErreur = "Nom d'utilisateur ou mot de passe incorrect.";
    }

    // Fermer la connexion après utilisation
    $db = null;
}

// Afficher le formulaire de connexion
include('./views/pages/login.php');

?>