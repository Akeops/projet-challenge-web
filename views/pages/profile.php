<?php if (!empty($_SESSION['error'])): ?>
    <p class="error"><?= htmlspecialchars($_SESSION['error']) ?></p>
    <?php unset($_SESSION['error']);
endif; ?>

<form action="index.php?page=profile" method="post">
    <label for="name">Nom :</label>
    <input type="text" id="name" name="name" value="<?= $profile['name'] ?? '' ?>">

    <label for="contactInfo">Informations de contact :</label>
    <textarea id="contactInfo" name="contactInfo"><?= $profile['contactInfo'] ?? '' ?></textarea>

    <label for="description">Description :</label>
    <textarea id="description" name="description"><?= $profile['description'] ?? '' ?></textarea>

    <label for="showInDirectory">Afficher dans l'annuaire :</label>
    <input type="checkbox" id="showInDirectory"
           name="showInDirectory" <?= $profile['showInDirectory'] ? 'checked' : '' ?>>

    <fieldset>
        <legend>Compétences :</legend>
        <?php foreach ($skills as $skill): ?>
            <div>
                <input type="checkbox" id="skill<?= $skill['id'] ?>" name="skills[]"
                       value="<?= $skill['id'] ?>" <?= is_array($selectedSkills) && in_array($skill['id'], $selectedSkills) ? 'checked' : '' ?>>
                <label for="skill<?= $skill['id'] ?>"><?= htmlspecialchars($skill['name']) ?></label>
            </div>
        <?php endforeach; ?>
    </fieldset>

    <button type="submit">Mettre à jour</button>
</form>
