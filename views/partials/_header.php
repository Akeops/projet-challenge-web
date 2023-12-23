<header>
    <nav>
        <div class="logo-container">
            <a href="index.php?page=home" class="logo-link">
                <img src="./img/logo.png" alt="Logo">
            </a>
        </div>
        <div class="nav-links">
            <a href="index.php?page=directory">ANNUAIRE</a>
            <a href="index.php?page=forum">FORUM</a>
        </div>

        <?php
        if (!isset($_SESSION['id'])) { ?>
            <div class="auth-links">
                <a href="index.php?page=login">CONNEXION</a>
                <a href="index.php?page=register">INSCRIPTION</a>
            </div>
        <?php } else { ?>
            <div class="auth-links">
                <a href="index.php?page=profile"><?php echo 'Profile: ', $_SESSION['username'] ?></a>
            </div>
        <?php } ?>
    </nav>
</header>
