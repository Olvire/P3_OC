<div class="page-header">
	<h3>Vos articles</h3>
</div>

<?php
if(empty($this->listOfArticles)) {
	echo '<p>Vous n\'avez pas encore publié d\'article. <a href="index.php?p=admin&amp;menu=write">Commencez ici</a></p>';
} else {
	// Liste des articles
	foreach($this->listOfArticles as $article) {
	?>
		<article class="list-article">

			<div class="article-header">
				<h4><?= htmlspecialchars($article->getTitle()); ?></h4>
				<p>
					<small>
					Rédigé le <?= $article->getDatePost()->format('d/m/Y à H:i:s'); ?>
					<?php if($article->getDateEdit()->format('d/m/Y') !== '30/11/-0001') {
						echo ' et modifié le ' . $article->getDateEdit()->format('d/m/Y');
					}
					?>
					</small>
				</p>
			</div>

			<div class="article-content">
				<em><?= substr($article->getContent(), 0, 350) . '...'; ?></em>
			</div>

			<div class="article-footer">
				<a class="btn btn-primary " href="index.php?p=single&id=<?= $article->getId(); ?>">Consulter</a>
				<a class="btn btn-default " href="index.php?p=admin&menu=write&action=edit&id=<?= $article->getId(); ?>">Éditer</a>
                <form method="post" role="form" action="index.php?p=admin&menu=list&action=delete&id=<?= $article->getId(); ?>"
                      style="display: inline;">
                    <input type="hidden" name="id" value="<?= $article->getId(); ?>">
                    <input type="submit" value="Supprimer" class="btn btn-danger">
                </form>
			</div>

		</article>
		<?php
	}
}
?>