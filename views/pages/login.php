<?php if (!empty($_SESSION['error'])): ?>
    <p class="error"><?= htmlspecialchars($_SESSION['error']) ?></p>
    <?php unset($_SESSION['error']);
endif; ?>

<form action="index.php?page=login" method="POST">
	<label for="email">Adresse email :</label>
	<input type="email" name="email" id="login">

	<label for="password">Mot de passe :</label>
	<input type="password" name="password" id="password">
	
	<input type="submit" value="Connexion">
</form>