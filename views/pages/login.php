<div class="auth-container">
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="error-container">
            <p class="error"><?= htmlspecialchars($_SESSION['error']) ?></p>
        </div>
        <?php unset($_SESSION['error']);
    endif; ?>

    <form action="index.php?page=login" method="POST" class="form">
        <label for="email" class="label">Adresse email :</label>
        <input type="email" name="email" id="login" class="input-field">

        <label for="password" class="label">Mot de passe :</label>
        <input type="password" name="password" id="password" class="input-field">

        <input type="submit" value="Connexion" class="submit-button">
    </form>
</div>
