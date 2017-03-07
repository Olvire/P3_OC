<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h3>Tableau de bord</h3>
		</div>
		
		<div class="row">
			<div class="col-sm-4 dashboard-left">
				<?php
				echo '<div class="dashboard-numbers">';
				echo '<h4>Quelques chiffres</h4>';
				echo '<p>Articles postés : <span class="text-success">' . $this->totalArticles . '</span><br>';
				echo 'Commentaires publiés : <span class="text-success">' . $this->totalComments . '</span><br>';
				echo 'Commentaires signalés : ';
				
				if($this->totalSignaledComments !== 0) {
					echo '<span class="text-danger">' . $this->totalSignaledComments . '</span>';
				} else {
					echo $this->totalSignaledComments;
				}

				echo '</p>';
				echo '</div>';
				?>
			</div>

			<div class="col-sm-offset-1 col-sm-7 dashboard-right">
				<?php
				echo '<h4>Vos dernières publications</h4>';
				foreach($this->lastArticles as $article) {
					echo '<article>';
					echo '<a href="index.php?p=single&amp;id=' . $article->getId() . '" target="_blank" title="Ouvrir dans un nouvel onglet">';
					echo '<h4><strong>' . htmlspecialchars($article->getTitle()) . '</strong></h4>';
					echo '</a>';
					echo '<small>Publié le ' . $article->getDatePost()->format('d/m/Y') . '</small><br>';
					echo substr($article->getContent(), 0, 300) . '<br>';
					echo '</article>';
					echo '<hr>';
				}
				?>
			</div>

		</div><!-- /.row -->
	</div><!-- /.col-xs-12 -->
</div><!-- /.row -->