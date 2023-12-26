<h1>Annuaire</h1>

<?php
// Assurez-vous que $getUsersByShowInDirectory est défini
if ($getUsersByShowInDirectory) {
    echo '<ul>';
    foreach ($getUsersByShowInDirectory as $user) {
        echo '<li>';
        echo '<strong>Username:</strong> ' . htmlspecialchars($user['name']) . '<br>';
        echo '<strong>Contact:</strong> ' . htmlspecialchars($user['contactInfo']) . '<br>';
        echo '<strong>Description:</strong> ' . htmlspecialchars($user['description']) . '<br>';
        // Ajoutez d'autres champs à afficher selon votre structure de données
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>Aucun utilisateur à afficher.</p>';
}

?>
