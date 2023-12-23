<?php if (!empty($_SESSION['error'])): ?>
    <p class="error"><?= htmlspecialchars($_SESSION['error']) ?></p>
    <?php unset($_SESSION['error']);
endif; ?>

<form action="index.php?page=register" method="post">
    <label for="username">Nom d'utilisateur:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required>

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required>

    <input type="submit" value="Inscription">
</form>
