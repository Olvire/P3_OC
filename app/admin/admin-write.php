<h3>
	<?php 
	if(isset($_GET['action']) AND $_GET['action'] == 'edit' AND isset($_GET['id'])) 
	{
		echo 'Mettre à jour l\'article';
	}
	else 
	{
		echo 'Nouvel article';
	}
	?>
</h3>
<br>
				
<?php
// Si l'on n'est pas en train d'éditer un article. 
if(!isset($_GET['action'])) 
{
	echo '<p>Vous pouvez rédiger un nouvel article. Il apparaîtra non seulement sur la page d\'accueil, mais aussi dans votre liste d\'articles.</p>';
}
?>
				
<br>
<?php

// Messages flash quand des actions sont effectuées
include '../app/flash-msg.php';

?>

<form action="" method="post">
	<div class="form-group">
		<label for="title">Titre </label>
		<input type="text" name="title" class="form-control" value="<?php if(isset($_GET['action']) AND $_GET['action'] == 'edit') echo $this->article->get_title(); ?>">
	</div>
	<div class="form-group">
		<label for="author">Auteur </label>
		<input type="text" name="author" class="form-control" id="disabledInput" value="<?php if(isset($_SESSION['username'])) echo $_SESSION['username']; ?> " <?php if(isset($_SESSION['username'])) echo 'disabled' ?>>
	</div>
	<div class="form-group">
		<label for="content">Contenu </label>
		<textarea name="content" class="form-control"><?php if(isset($_GET['action']) AND $_GET['action'] == 'edit') echo $this->article->get_content(); ?></textarea>
	</div>

	<?php
	// Si on édite un article, le bouton d'envoi devient 'Mettre à jour'.
	if(isset($_GET['action']) AND $_GET['action'] == 'edit') {
		?>
		<input type="hidden" name="id" value="<?= $this->article->get_id(); ?>" />
		<button type="submit" class="btn btn-warning">Mettre à jour</button>
		<?php
	}
	// Sinon, le bouton d'envoi permet de publier un article.
	else 
	{
		?>
		<button type="submit" class="btn btn-primary">Publier</button>
		<?php
	}
	?>
</form>