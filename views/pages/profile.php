<?php global $skills; ?>

<div class="profile-container">
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="error-container">
            <p class="error"><?= htmlspecialchars($_SESSION['error']) ?></p>
        </div>
        <?php unset($_SESSION['error']);
    endif; ?>

    <form action="index.php?page=profile" method="post" class="profile-form">
        <label for="name" class="profile-label">Nom :</label>
        <input type="text" id="name" name="name" value="<?= $profile['name'] ?? '' ?>" class="profile-input"
               maxlength="50">

        <label for="contactInfo" class="profile-label">Information de contact :</label>
        <textarea id="contactInfo" name="contactInfo" class="profile-textarea"
                  maxlength="500"><?= $profile['contactInfo'] ?? '' ?></textarea>
        <span id="contactInfo-counter" class="char-counter">500 caractères restants</span>

        <label for="description" class="profile-label">Description :</label>
        <textarea id="description" name="description" class="profile-textarea"
                  maxlength="1000"><?= $profile['description'] ?? '' ?></textarea>
        <span id="description-counter" class="char-counter">1000 caractères restants</span>

        <label for="showInDirectory" class="profile-label">Afficher dans l'annuaire :</label>
        <input type="checkbox" id="showInDirectory"
               name="showInDirectory" <?= $profile['showInDirectory'] ? 'checked' : '' ?> class="profile-checkbox">

        <fieldset class="fieldset">
            <legend class="legend">Compétences :</legend>
            <?php foreach ($skills as $skill): ?>
                <div>
                    <input type="checkbox" id="skill<?= $skill['id'] ?>" name="skills[]"
                           value="<?= $skill['id'] ?>" <?= is_array($selectedSkills) && in_array($skill['id'], $selectedSkills) ? 'checked' : '' ?>
                           class="profile-checkbox">
                    <label for="skill<?= $skill['id'] ?>"
                           class="profile-label"><?= htmlspecialchars($skill['name']) ?></label>
                </div>
            <?php endforeach; ?>
        </fieldset>

        <button type="submit" class="update-button">Mettre à jour</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function updateCharCounter(textareaId, counterId, maxLength) {
            var textarea = document.getElementById(textareaId);
            var counter = document.getElementById(counterId);

            function updateCounter() {
                var remaining = maxLength - textarea.value.length;
                counter.textContent = remaining + " caractères restants";
            }

            textarea.addEventListener('input', updateCounter);
            updateCounter();
        }

        updateCharCounter('contactInfo', 'contactInfo-counter', 500);
        updateCharCounter('description', 'description-counter', 1000);
    });
</script>

