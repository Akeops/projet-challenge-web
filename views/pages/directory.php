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

        if (!empty($userSkills)) {
            echo '<strong>Compétences:</strong> ';
            foreach ($userSkills as $skills) {
                if (is_array($skills)) {
                    foreach ($skills as $skill) {
                        echo " - " . htmlspecialchars($skill);
                    }
                } else {
                    echo htmlspecialchars($skills) . ', ';
                }
            }      
        } else {
            echo '<em>Aucune compétence trouvée pour cet utilisateur.</em><br>';
        }
        echo '<hr>'; // Une ligne horizontale pour séparer les utilisateurs, facultatif

        echo '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>Aucun utilisateur à afficher.</p>';
}
?>
