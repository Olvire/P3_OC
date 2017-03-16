<?php
/**
 * Classe pour la vue Home.
 */
class ViewHome
{
	// Attributs nécessaires à la vue.
	private $listOfArticles;
	private $numberOfPages;
	private $currentPage;

	public function __construct($listOfArticles, $numberOfPages, $currentPage)
	{
		$this->listOfArticles = $listOfArticles;
		$this->numberOfPages = $numberOfPages;
		$this->currentPage = $currentPage;
	}
	
	/**
	 * Se charge d'afficher le contenu de la vue.
	 */
	public function display()
	{
		?>
		
		<div class="home-container">
			
			<!-- Image décorative en haut de la page. -->
			<div class="home-pic-top"></div>
			
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<?php
						if(empty($this->listOfArticles)) {
							echo '<div class="alert alert-danger">';
							echo '<p>Aucun article n\'a été publié pour le moment. Patientez un peu, l\'auteur est en plein travail.</p>';
							echo '</div>';
							if(isset($_SESSION['username']) AND $_SESSION['username'] == 'Jean') {
								echo '<p><a class="btn btn-default" href="index.php?p=admin&amp;menu=write">Commencez ici</a></p>';
							} 
						} else {
							// Affichage des articles.
							foreach($this->listOfArticles as $article) { ?>
								<article>
									<section class="header">
										<!-- Dans le header de l'article, titre, date de publication et auteur. -->
										<h2><?= htmlspecialchars($article->getTitle()); ?></h2>
										<p class="date-comments">
											<small>
												<i class="fa fa-clock-o" aria-hidden="true"></i>
												<?= $article->getAuthor(); ?> |
												<?= $article->getDatePost()->format("d/m/Y"); ?> | <?php if($article->getDateEdit()->format('d/m/Y') !== '30/11/-0001') { echo ' Édité le ' . $article->getDateEdit()->format('d/m/Y à H:i:s'); 
													} ?>
											</small>
										</p>
									</section>
									
									<!-- Contenu de l'article, limité à 700 caractères. -->
									<section class="content">
										<?= substr($article->getContent(), 0, 700) . '...'; ?>
									</section>
											
									<br>
									
									<!-- Lien pour lire la suite de l'article via la vue Single. -->
									<p class="text-right"><a href="index.php?p=single&amp;id=<?= $article->getId(); ?>" class="btn btn-default">Lire la suite</a></p>
								</article>

							<?php
							}
						}
						?>
						
						<!-- Système de pagination -->
						<nav aria-label="Page navigation" class="text-center">
							<ul class="pagination">
							<?php
							for($i = 1; $i <= $this->numberOfPages; $i++) {
								if($i == $this->currentPage) { 
									echo '<li class="active"><a href="#">' . $i . '<span class="sr-only">(current)</span></a></li>';
								} else {
									echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
								}
							}
							?>
							</ul>
						</nav>
					</div>
				</div> <!-- /row -->
			</div> <!-- /container -->
		</div><!-- /home-container -->

		<?php
	}
}