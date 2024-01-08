<section id="presentation">
    <div class="auth-container-directory">
        <form action="index.php" method="get" id="searchForm" onsubmit="return validateForm()" class="form-directory">
            <input type="hidden" name="page" value="directory">
            <label for="searchField"></label>
            <input type="text" name="search" value="" id="searchField" class="input-field-directory"
                   placeholder="<?php echo ($userRole === 'admin') ? 'Recherche par ID ou rôle...' : 'Recherche par nom ou compétences...'; ?>">
            <input type="submit" value="Filtrer" class="submit-button-directory">
            <button type="button" onclick="resetSearch()" class="submit-button-directory">Reset</button>
        </form>
    </div>

    <script>
        function validateForm() {
            const searchValue = document.getElementById('searchField').value.trim();
            return searchValue !== '';
        }

        function resetSearch() {
            document.getElementById('searchField').value = '';
            document.getElementById('searchForm').submit();
        }

        document.getElementById('searchField').value = '<?php echo $searchTerm; ?>';
    </script>

    <?php
    echo '<div class="auth-container-directory">';
    echo '<div class="form-directory">';
    for ($nbpage = $startPage; $nbpage <= $endPage; $nbpage++) {
        echo '<a class="submit-button-directory" href="?page=directory&nbpage=' . $nbpage . '&search=' . urlencode($searchTerm) . '">' . $nbpage . '</a> ';
    }
    echo '</div>';
    echo '</div>';

    if ($userRole === 'admin') {
        echo '<div class="divPresentation">';
        echo '<div class="presentationDescription">';
        echo '<ul>';

        foreach ($displayUsers as $userId => $user) {
            echo '<li>';
            echo '<strong>UserId:</strong> ' . htmlspecialchars($user['userId']) . '<br><br>';
            echo '<strong>Username:</strong> ' . htmlspecialchars($user['name']) . '<br><br>';
            echo '<strong>Role:</strong> ' . htmlspecialchars($user['role']) . '<br><br>';
            echo "<a href='index.php?page=directory&deleteUser&userId=" . $user['userId'] . "'>Supprimer utilisateur</a><br>";
            if ($user['role'] === 'modo') {
                echo "<a href='index.php?page=directory&downgradeToStandard&userId=" . $user['userId'] . "'>Retirer modérateur</a><br>";
            } else {
                echo "<a href='index.php?page=directory&grantModo&userId=" . $user['userId'] . "'>Ajouter modérateur</a><br>";
            }
            echo '<hr>';
            echo '</li>';
        }

        echo '</ul>';
        echo '</div>';
        echo '</div>';
    } else {
        if (!empty($displayUsers)) {
            echo '<div class="divPresentation">';
            echo '<div class="presentationDescription">';
            echo '<ul>';

            foreach ($displayUsers as $userId => $user) {
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
            echo '</div>';
        } else {
            echo '<p>Aucun utilisateur à afficher.</p>';
        }
    }
    ?>
</section>