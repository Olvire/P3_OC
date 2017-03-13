<div class="settings">
	<div class="page-header">
		<h2>Réglages</h2>
	</div>

	<h4>Page &laquo; À propos &raquo;</h4>

	<p class="text-justify">Entrez une description de votre blog, fournissez des informations de contact et ce qui vous paraîtra important. Cela apparaitra dans la page &laquo; À propos &raquo; de votre site.</p>

	<form action="" method="post">
		<textarea name="about-description" class="form-control"></textarea><br>
		<input type="submit" class="btn btn-default btn-sm" value="Mettre à jour">
	</form>

	<br>

	<h4>Vos articles</h4>

	<p><a onclick="return(confirm('Êtes-vous sûr de vouloir supprimer tous les articles ?'));" href="index.php?p=admin&amp;menu=settings&amp;action=truncate">Supprimer tous les articles</a></p>
	<p><a onclick="return(confirm('Êtes-vous sûr de vouloir supprimer tous les commentaires ?'));" href="index.php?p=admin&amp;action=deleteAllComments">Supprimer tous les commentaires</a></p>
	<br>

	<h4>Votre compte</h4>

	<p><a href="../inc/logout.php">Me déconnecter</a></p>
</div>