<?php

class ViewSingle
{
	private $articleUnique;
	private $listeCommentaires;
	private $nb;
	private $lastArticles;

	public function __construct($articleUnique, $listeCommentaires, $nb, $lastArticles)
	{
		$this->articleUnique = $articleUnique;
		$this->listeCommentaires = $listeCommentaires;
		$this->nb = $nb;
		$this->lastArticles = $lastArticles;
	}

	public function display()
	{
		?>

		<div class="single-container">
			<div class="container">
				<div class="row">
					<article class="col-md-8">
						<div class="article-unique-header">
							<h1><?= htmlspecialchars($this->articleUnique->get_title()); ?></h1>
							<p class="date-post"><small>Publié le <?= $this->articleUnique->get_date_post()->format('d/m/Y') ?></small></p>
							<?php 
							if(isset($_SESSION['username']) AND isset($_SESSION['password'])) { 
								echo '<small><a class="btn btn-default btn-xs" href="index.php?p=admin&amp;menu=write&amp;action=edit&amp;id='.$this->articleUnique->get_id().'">Modifier</a></small>'; 
							} ?>
						</div>

						<div class="article-content">
							<?= $this->articleUnique->get_content(); ?>
						</div>

						<hr>

						<h4 id="comments">Commentaires (<?= $this->nb; ?>)</h4>
						
						<div class="comments-container">
							<?php
							foreach($this->listeCommentaires as $comment) {
								?>
								<div id="comment">
									<p>
										<strong><?= htmlspecialchars($comment->get_author()); ?></strong>
										<small>Le <?= $comment->get_date_post()->format('d/m/y à H:i:s'); ?> <span id="commentaire-repondre">Répondre</span></small><br>
										<em><?= htmlspecialchars($comment->get_content()); ?></em>
									</p>
									
									<?php
									// Afficher ici la liste des sous-commentaires
									?>
									
									<small><a href="index.php?p=single&id=<?= $this->articleUnique->get_id(); ?>&action=signal&comment_id=<?= $comment->get_id(); ?>">Signaler</a></small>
								</div>
							<?php
							}
							?>
						</div>

						<hr>

						<h4 id="poster-commentaire">Poster un commentaire</h4>
						<?php include('../app/single/single-write-comment.php'); ?>
						<br>
						<a href="index.php"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Retour à la page d'accueil</a>
					</article>

					<aside class="col-md-offset-1 col-md-3">
						<h3>Les derniers articles</h3>

						<?php
						foreach($this->lastArticles as $article)
						{
						?>
							<h5><a href="?p=single&amp;id=<?= $article->get_id(); ?>"><?= $article->get_title(); ?></a></h5>
							<small><em><i class="fa fa-calendar" aria-hidden="true"></i> <?= $article->get_date_post()->format('d/m/y'); ?></em></small>
							<p><?= substr($article->get_content(), 0, 100) . '...'; ?></p>
							<hr>
						<?php
						}
						?>
					</aside>
				</div>
			</div>
		</div>
	
		<?php
	}
}