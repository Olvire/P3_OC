<?php 
if(isset($_GET['action']) AND $_GET['action'] == 'edit' AND isset($_GET['id'])) {
	echo '<div class="page-header">';
	echo '<h3>Mettre à jour l\'article</h3>';
	echo '</div>';
} else {
	echo '<div class="page-header">';
	echo '<h3>Nouvel article</h3>';
	echo '</div>';
}

// Si l'on n'est pas en train d'éditer un article. 
if(!isset($_GET['action'])) {
	echo '<p>Vous pouvez rédiger un nouvel article. Il apparaîtra non seulement sur la page d\'accueil, mais aussi dans votre liste d\'articles.</p>';
}

?>

<form action="" method="post">
	<div class="form-group">
		<label for="title">Titre </label>
		<input type="text" name="title" class="form-control" value="<?php if(isset($_GET['action']) AND $_GET['action'] == 'edit') echo $this->article->getTitle(); ?>" />
	</div>
	<div class="form-group">
		<label for="author">Auteur </label>
		<input type="text" name="author" class="form-control" value="<?php if(isset($_GET['action']) AND $_GET['action'] == 'edit') echo $this->article->getAuthor(); ?>" />
	</div>
	<div class="form-group">
		<label for="content">Contenu </label>
		<textarea name="content" class="form-control"><?php if(isset($_GET['action']) AND $_GET['action'] == 'edit') echo $this->article->getContent(); ?></textarea>
	</div>

	<?php
	// Si on édite un article, le bouton d'envoi devient 'Mettre à jour'.
	if(isset($_GET['action']) AND $_GET['action'] == 'edit') {
		?>
		<input type="hidden" name="id" value="<?= $this->article->getId(); ?>" />
		<button type="submit" class="btn btn-warning">Mettre à jour</button>
		<?php
	}
	// Sinon, le bouton d'envoi permet de publier un article.
	else {
		?>
		<button type="submit" class="btn btn-primary">Publier</button>
		<?php
	}
	?>
</form>