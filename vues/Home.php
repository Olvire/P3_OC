<?php
/**
 * Class for view home.
 */
class ViewHome
{
	private $listOfArticles;
	private $numberOfPages;
	private $currentPage;

	public function __construct($listOfArticles, $numberOfPages, $currentPage)
	{
		$this->listOfArticles = $listOfArticles;
		$this->numberOfPages = $numberOfPages;
		$this->currentPage = $currentPage;
	}
	
	public function display()
	{
		?>
		
		<div class="home-container">

			<div class="home-pic-top"></div>
			
			<div class="container">
				<div class="row">
					<div class="col-xs-12>
						<?php
						foreach($this->listOfArticles as $article) { ?>
							<article>
								<section class="header">
									<h2><?= htmlspecialchars($article->getTitle()); ?></h2>
									<p class="date-comments">
										<small>
											<i class="fa fa-clock-o" aria-hidden="true"></i>
											<?= $article->getDatePost()->format("d/m/y"); ?> |
										</small>
									</p>
								</section>

								<section class="content">
									<?= substr($article->getContent(), 0, 700) . '...'; ?>
								</section>
										
								<br>

								<p class="text-right"><a href="index.php?p=single&amp;id=<?= $article->getId(); ?>" class="btn btn-default">Lire la suite</a></p>
							</article>

							<?php
							}
							?>
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