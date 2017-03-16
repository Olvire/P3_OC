<?php

/**
 * Classe pour la vue Single
 */
class ViewSingle
{
	// Attributs nécessaires à la vue.
	private $articleUnique;
	private $listOfComments;
	private $numberOfComments;
	private $lastArticles;

	public function __construct($articleUnique, $listOfComments, $numberOfComments, $lastArticles)
	{
		$this->articleUnique = $articleUnique;
		$this->listOfComments = $listOfComments;
		$this->numberOfComments = $numberOfComments;
		$this->lastArticles = $lastArticles;
	}

	/**
	 * Se charge d'afficher le contenu de la vue.
	 */
	public function display()
	{
		?>

		<div class="single-container">
			<div class="container">
				<div class="row">

					<!-- Début de l'article unique -->
					<article class="col-md-8">
						<div class="article-unique-header">
							<h1><?= htmlspecialchars($this->articleUnique->getTitle()); ?></h1>
							<p class="date-post">

								Publié le <?= $this->articleUnique->getDatePost()->format('d/m/Y') ?>

								<?php
								// Affichage de la date formatée de publication de l'article.
								if($this->articleUnique->getDateEdit()->format('d/m/Y') !== '30/11/-0001') {
									echo '| Cet article a été édité le ' . $this->articleUnique->getDateEdit()->format('d/m/Y à H:i:s') . ' ';
								}

								// Si la session est ouverte au nom de Jean, on donne la possibilité d'éditer l'article.
								if(isset($_SESSION['username']) AND $_SESSION['username'] == 'Jean') { 
									echo '<small><a class="btn btn-default btn-xs" href="index.php?p=admin&amp;menu=write&amp;action=edit&amp;id=' . $this->articleUnique->getId() . '">Éditer</a></small>'; 
								}
								?>

							</p>
						</div>
						
						<!-- Contenu de l'article unique -->
						<div class="article-content"><?= $this->articleUnique->getContent(); ?></div>

						<hr>

						<h4 id="comments">Commentaires (<?= $this->numberOfComments; ?>)</h4>
						
						<?php
						// Premier niveau de commentaires
						foreach($this->listOfComments as $comment) {
						?>
						<div class="comment">
							<div class="comment-header">
								<p>	
									<strong><?= htmlspecialchars($comment->getAuthor()); ?></strong> <!-- Auteur du commentaire -->
									<small>Le <?= $comment->getDatePost()->format('d/m/y à H:i:s'); ?></small> <!-- Date de publication formatée -->
									<?php
									if(empty($comment->getSignaler())) { // Si l'attribut 'signaler' est vide, on affiche le lien pour signaler.
									?>
									<a href="index.php?p=single&amp;id=<?= $this->articleUnique->getId(); ?>&amp;action=signal&amp;commentId=<?= $comment->getId(); ?>"><small class="signal pull-right">Signaler</small></a>
									<?php
									// Sinon, on affiche un message d'alerte pour prévenir que le commentaire a été signalé.
									} else {
										echo '<small class="text-danger">Le commentaire a été signalé et est en attente de modération.</small>';
									}
									?>
								</p>
							</div>
							<!-- Contenu du commentaire -->
							<div class="comment-content">
								<p><?= htmlspecialchars($comment->getContent()); ?></p>
							</div>

							<?php
							// Deuxième niveau de commentaires
							foreach($comment->getSubComments() as $subComment) {
							?>
							<div class="subComment">
								<div class="comment-header">
									<p>
										<strong><?= htmlspecialchars($subComment->getAuthor()); ?></strong>
										<small>Le <?= $subComment->getDatePost()->format('d/m/y H:i:s'); ?></small>
										<?php
										if(empty($subComment->getSignaler())) {
										?>
										<a href="index.php?p=single&amp;id=<?= $this->articleUnique->getId(); ?>&amp;action=signal&amp;commentId=<?= $subComment->getId(); ?>"><small class="signal pull-right">Signaler</small></a>
										<?php
										} else {
											echo '<small class="text-danger">Le commentaire a été signalé et est en attente de modération.</small>';
										}
										?>
									</p>
								</div>

								<!-- Contenu du commentaire -->
								<div class="comment-content">
									<p><?= htmlspecialchars($subComment->getContent()); ?></p>
								</div>

								<?php
								// Troisième et dernier niveau de commentaires
								foreach($subComment->getSubComments() as $subSubComment) {
								?>
								<div class="subSubComment">
									<div class="comment-header">
										<p>
											<strong><?= htmlspecialchars($subSubComment->getAuthor()); ?></strong>
											<small>Le <?= $subSubComment->getDatePost()->format('d/m/y H:i:s'); ?></small>
											<?php
											if(empty($subSubComment->getSignaler())) {
											?>
											<a href="index.php?p=single&amp;id=<?= $this->articleUnique->getId(); ?>&amp;action=signal&amp;commentId=<?= $subSubComment->getId(); ?>"><small class="signal pull-right">Signaler</small></a>
											<?php
											} else {
												echo '<small class="text-danger">Le commentaire a été signalé et est en attente de modération.</small>';
											}
											?>
										</p>
									</div>
									
									<!-- Contenu du commentaire -->
									<div class="comment-content">
										<p><?= htmlspecialchars($subSubComment->getContent()); ?></p>
									</div>
									
									<span title="Répondre" class="repondre-commentaire"><small>Répondre</small></span>

									<!-- Répondre au commentaire de 3è niveau -->
									<div class="comment-footer">
										<form action="index.php?p=single&amp;id=<?= $this->articleUnique->getId(); ?>#comments" method="post">
											<?php
											if(!isset($_SESSION['username'])) {
												?>
												<input type="text" name="author" placeholder="Pseudo" required />
												<?php
											}
											?>
											<textarea name="content" placeholder="Votre commentaire"></textarea>
											<input type="hidden" name="parentId" value="<?= $subComment->getId(); ?>">
											<input type="submit" value="Envoyer" class="btn btn-default btn-xs" required />
										</form>
									</div>
								</div>
								<?php
								}
								?>

								<span title="Répondre" class="repondre-commentaire"><small>Répondre</small></span>
								<!-- Répondre au commentaire de 2è niveau -->
								<div class="comment-footer">
									<form action="index.php?p=single&amp;id=<?= $this->articleUnique->getId(); ?>#comments" method="post">
										<?php
										if(!isset($_SESSION['username'])) {
											?>
											<input type="text" name="author" placeholder="Pseudo" required />
											<?php
										}
										?>
										<textarea name="content" placeholder="Votre commentaire"></textarea>
										<input type="hidden" name="parentId" value="<?= $subComment->getId(); ?>">
										<input type="submit" value="Envoyer" class="btn btn-default btn-xs" required />
									</form>
								</div>
							</div>
							<?php	
							}
							?>
							
							<span title="Répondre" class="repondre-commentaire"><small>Répondre</small></span>

							<!-- Répondre au commentaire de 1er niveau -->
							<div class="comment-footer">
								<?php
								?>
								<form action="index.php?p=single&amp;id=<?= $this->articleUnique->getId(); ?>#comments" method="post">
									<?php
									if(!isset($_SESSION['username'])) {
										?>
										<input type="text" name="author" placeholder="Pseudo" required />
										<?php
									}
									?>
									<textarea name="content" placeholder="Votre commentaire"></textarea>
									<input type="hidden" name="parentId" value="<?= $comment->getId(); ?>">
									<input type="submit" value="Envoyer" class="btn btn-default btn-xs" required />
								</form>
							</div>
						</div>
						<?php
						}
						?>

						<hr>
						
						<!-- Poster un nouveau commentaire -->
						<h4 id="poster-commentaire">Poster un nouveau commentaire</h4>
						<?php include('../inc/single/single-write-comment.php'); ?>
						<br>
						<a class="to-home" href="index.php"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Retour à la page d'accueil</a>
					</article>
					

					<!-- Liste des 3 derniers articles -->
					<aside class="col-md-offset-1 col-md-3">
						<h3>Les derniers articles</h3>

						<?php
						foreach($this->lastArticles as $article)
						{
						?>
							<h5><a class="aside-article-name" href="?p=single&amp;id=<?= $article->getId(); ?>"><?= $article->getTitle(); ?></a></h5>
							<small><em><i class="fa fa-calendar" aria-hidden="true"></i> Publié le <?= $article->getDatePost()->format('d/m/y'); ?></em></small>
							<p><?= substr($article->getContent(), 0, 150) . '...'; ?></p>
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