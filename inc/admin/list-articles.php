<div class="page-header">
	<h3>Vos articles</h3>
</div>

<?php
foreach($this->listOfArticles as $article) {
?>
	<article class="list-article">
		<div class="article-header">
			<h4><?= htmlspecialchars($article->getTitle()); ?></h4>
			<p>
				<small>
				Cet article a été rédigé le <?= $article->getDatePost()->format('d/m/Y à H:i:s'); ?>
				<?php if($article->getDateEdit()->format('d/m/Y') !== '30/11/-0001') {
					echo ' et modifié le ' . $article->getDateEdit()->format('d/m/Y');
				}
				?>
				</small>
			</p>
		</div>

		<div class="article-content">
			<em><?= substr($article->getContent(), 0, 150); ?></em>
		</div>

		<div class="article-footer">
			<a class="btn btn-primary btn-xs" href="index.php?p=single&id=<?= $article->getId(); ?>">Consulter</a>
			<a class="btn btn-default btn-xs" href="index.php?p=admin&menu=write&action=edit&id=<?= $article->getId(); ?>">Éditer</a>
			<a class="btn btn-default btn-xs" href="index.php?p=admin&menu=list&action=delete&id=<?= $article->getId(); ?>"">Supprimer</a>
		</div>
	</article>
	<?php
}
?>