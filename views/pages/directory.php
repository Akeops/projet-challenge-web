<section id="presentation">
<div class="section-title">
</div>
<?php
    if (!empty($users)) { ?>
<div class="divPresentation">
<div class="presentationDescription">
<?php
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
            ?>
</div>
</section>
