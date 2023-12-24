<div class="auth-container">
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="error-container">
            <p class="error"><?= htmlspecialchars($_SESSION['error']) ?></p>
        </div>
        <?php unset($_SESSION['error']);
    endif; ?>

    <form action="index.php?page=register" method="post" class="form">
        <label for="username" class="label">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required class="input-field">

        <label for="password" class="label">Mot de passe:</label>
        <input type="password" id="password" name="password" required class="input-field">

        <label for="email" class="label">E-mail:</label>
        <input type="email" id="email" name="email" required class="input-field">

        <input type="submit" value="Inscription" class="submit-button">
    </form>
</div>
