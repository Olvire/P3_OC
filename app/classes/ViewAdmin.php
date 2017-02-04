<?php

class ViewAdmin
{
	public function display()
	{
	?>
	
	<h1>Administration</h1>
	<p>Hello dear administrator,</p>
	<p>On this page, you'll be able to add, edit, or delete articles of the blog. You can see the number of articles already created and you have the possibility to delete every articles.</p>
	<p>If you want to ask questions about this administration page, the blog, or just want to contact us, please send a message to <a href="#">contact@admin.com</a>. Thank you!

	<!-- Début du compteur d'articles -->
	<h2>Total number of articles</h2>
	<p>The current number of articles in the database is : <span class="text-primary"><strong><?= $manager->count(); ?></strong></span>
	<hr>

	<h2>Write an article</h2>
	<form action="admin.php" method="post">
	<?php
	echo $adminForm->title_field();
	echo $adminForm->author_field();
	echo $adminForm->content_field();
	echo $adminForm->submit();
	?>
	</form>

	<hr>

	<!-- Début de la liste d'articles -->
	<h2>List of articles</h2>
	<?
	$liste = $manager->get_articles();
	if($manager->count() == 0)
	{
		echo 'There\'s no article in the database.';
	} else {
		foreach($liste as $article)
		{
			?>
			<div class="article">
				<h3>
					<?= '<em>#' . $article->get_id() . '</em> ' . htmlspecialchars($article->get_title()); ?>
				</h3>
							
				<p><small>Written by <?= htmlspecialchars($article->get_author()); ?></small></p>
							
				<p><?= $article->get_content(); ?></p>

				<form action="." method="post">
					<a href="?edit&id='<?= $article->get_id(); ?>'" class="btn btn-warning btn-sm" disabled="disabled">Edit</a>
					<a href="?delete&id='<?= $article->get_id(); ?>'" class="btn btn-danger btn-sm">Supprimer</a>
				</form>
							
				<hr>
			</div>
			<?php
		}
	}
	?>

	<h2>Dangerous zone</h2>
	<p>The button herebelow will delete all the articles in the database.</p>
	<form action="#" method="post">
		<button type="submit" name="truncate" class="btn btn-danger btn-sm">DELETE ARTICLES</button>
	</form><br>
	</div>
	<?php
	}
}