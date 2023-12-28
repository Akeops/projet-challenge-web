<section id="presentation">
<div class="section-title">
<h2 class="titreH2">Annuaire</h2>
</div>
<?php
    // Assurez-vous que $users est défini et non vide
    if (!empty($users)) { ?>
<div class="divPresentation">
<div class="presentationDescription">
<?php
                echo '<ul>';
                foreach ($users as $user) {
                    echo '<li>';
                    echo '<strong>Username:</strong> ' . htmlspecialchars($user['name']) . '<br><br>';
                    echo '<strong>Contact:</strong> ' . htmlspecialchars($user['contactInfo']) . '<br><br>';
                    echo '<strong>Description:</strong> ' . htmlspecialchars($user['description']) . '<br><br>';
                    if (!empty($user['skills'])) {
                        echo '<strong>Compétences:</strong> ';
                        foreach ($user['skills'] as $skill) {
                            echo htmlspecialchars($skill) . ', ';
                        }
                    } else {
                        echo '<em>Aucune compétence trouvée pour cet utilisateur.</em><br>';
                    }
                    echo '<hr>'; // Une ligne horizontale pour séparer les utilisateurs, facultatif
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
