<div class="home">
	<section id="about">
		<h1>Blog dev</h1>
		<p>Voici la liste des articles</p>
	</section>
	<section id="last-articles">
        
	<?php 
    
    foreach ($blogs as $blog) { ?>
        
		<article>
			<h2><?= $blog['titre']; ?></h2>
			<a href="<?= 'index.php?page=showBlog&id=' . $blog['id']; ?>">Lire le blog</a>
		</article>
	<?php } ?>
	</section>
</div>