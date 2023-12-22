<header>
	<nav>
	<?php
		if(isset($_SESSION['id'])){ ?>
			<a href="../../index.php?page=home">Accueil</a>
		<?php } else { ?>
			<a href="../../index.php?page=home">Accueil</a>
			<a href="../../index.php?page=login">Connexion</a>
        	<a href="../../index.php?page=register">Inscription</a>
		<?php } ?>
		
	</nav>
</header>
