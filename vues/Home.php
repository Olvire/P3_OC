<?php
/**
 * Class for view home.
 */
class ViewHome
{
	private $liste_articles;
	private $nombre_de_pages;
	private $page_actuelle;

	public function __construct($liste_articles, $nombre_de_pages, $page_actuelle)
	{
		$this->liste_articles = $liste_articles;
		$this->nombre_de_pages = $nombre_de_pages;
		$this->page_actuelle = $page_actuelle;
	}
	
	public function display()
	{
		?>
		
		<div class="home-container">
			<div class="container">
				<?php
				foreach($this->liste_articles as $article) {
					?>
					<div class="home-article">
						<div class="row">
							<div class="col-md-2">
								<div class="post-date-big text-center">
									<i class="fa fa-clock-o" aria-hidden="true"></i><br>
									<small><?= $article->get_date_post()->format("d/m/y H:i"); ?></small>	
								</div>
							</div>
							<div class="col-md-10">
								<div class="home-article-header">
									<h2><?= htmlspecialchars($article->get_title()); ?></h2>
									<p class="post-date-small"><small>Publié le <?= $article->get_date_post()->format('d/m/y à H:i:s'); ?></small></p>
									<hr>
								</div>
								<div class="home-article-content">
									<?= substr($article->get_content(), 0, 400) . '...'; ?>
								</div>
								<p><a class="btn btn-default" href="index.php?p=single&amp;id=<?= $article->get_id(); ?>">Lire la suite</a></p>
							</div>
						</div>
					</div>

					<hr class="home-hr">
				<?php
				}
				?>
				<nav aria-label="Page navigation" class="text-center">
					<ul class="pagination">
						<?php
						for($i = 1; $i <= $this->nombre_de_pages; $i++) {
							// Différenciation de la page actuelle et de la page accessible.
							if($i == $this->page_actuelle) { 
								echo '<li class="active"><a href="#">' . $i . '<span class="sr-only">(current)</span></a></li>';
							} else {
								echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
							}
						}
						?>
					</ul>
				</nav>
			</div>
		</div>

		<?php
	}
}