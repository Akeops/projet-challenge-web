<section id="presentation">
    <?php
    if ($userRole === 'admin') {
        echo '<div class="divPresentation">';
        echo '<div class="presentationDescription">';
        echo '<ul>';
        foreach ($usersAll as $user) {
            echo '<li>';
            echo '<strong>UserId:</strong> ' . htmlspecialchars($user['userId']) . '<br><br>';
            echo '<strong>Username:</strong> ' . htmlspecialchars($user['username']) . '<br><br>';
            echo '<strong>Role:</strong> ' . htmlspecialchars($user['role']) . '<br><br>';
            echo '<hr>';
            echo '</li>';
            echo "<a href='index.php?page=directory&deleteUser&userId=" . $user['userId'] . "'>Supprimer utilsateur</a><br>";
            if ($user['role'] === 'modo') {
                echo "<a href='index.php?page=directory&downgradeToStandard&userId=" . $user['userId'] . "'>Retirer modérateur</a><br>";
            } else {
                echo "<a href='index.php?page=directory&grantModo&userId=" . $user['userId'] . "'>Ajouter modérateur</a><br>";
            }
        }
        echo '</ul>';
        echo '</div>';
        echo '</div>';
    }

    if ($userRole === 'standard' || $userRole === 'modo' || $userRole === null) {
        if (!empty($users)) {
            echo '<div class="divPresentation">';
            echo '<div class="presentationDescription">';
            echo '<ul>';
            foreach ($users as $user) {
                echo '<li>';
                echo '<strong>Nom:</strong> ' . htmlspecialchars($user['name']) . '<br><br>';
                echo '<strong>Contact:</strong> ' . htmlspecialchars($user['contactInfo']) . '<br><br>';
                echo '<strong>Description:</strong> ' . htmlspecialchars($user['description']) . '<br><br>';
                if (!empty($user['skills'])) {
                    echo '<strong>Compétences:</strong> ';
                    foreach ($user['skills'] as $skill) {
                        echo " - " . htmlspecialchars($skill);
                    }
                } else {
                    echo '<em>Aucune compétence trouvée pour cet utilisateur.</em><br>';
                }
                echo '<hr>';
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';
        } else {
            echo '<p>Aucun utilisateur à afficher.</p>';
        }
        echo '</div>';
    }
    ?>
</section>