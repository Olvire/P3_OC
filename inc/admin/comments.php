<div class="page-header">
	<h3>Commentaires</h3>
</div>

<?php
if(empty($this->listOfComments)) {
	echo '<p>Aucun commentaire n\'a été posté pour le moment.</p>';
} else { ?>
	<table class="table">
		<thead>
			<th>N° Article</th>
			<th>Commentaire</th>
			<th>Auteur</th>
			<th>Action</th>
		</thead>

		<tbody>
			<?php
			foreach($this->listOfComments as $comment) { ?>
				<tr <?php if($comment->getSignaler() == 1) echo 'class="bg-danger"'?>>
					<td><a href="?p=single&amp;id=<?= $comment->getArticleId(); ?>"><?= $comment->getArticleId(); ?></a></td>
					<td><em>
						<?php 
						if(strlen($comment->getContent() >= 200)) {
							echo substr($comment->getContent(), 0, 50) . '...';
						} else {
							echo substr($comment->getContent(), 0, 100); 
						}
						?>	
					</em></td>

					<td><strong><?= $comment->getAuthor(); ?></strong></td>
					<td><a href="?p=admin&amp;menu=comments&amp;action=deleteComment&amp;commentId=<?= $comment->getId(); ?>">Supprimer</a></td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>

	<div class="col-xs-12 signaled-comments">
		<h4>Commentaires signalés</h4>

		<?php 
		if(empty($this->signaledComments)) {
			echo 'Aucun commentaire n\'a été signalé pour le moment.';
		} else {
		?>
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead>
				<th>Auteur</th>
				<th>Contenu</th>
				<th>Le</th>
				<th>Action</th>
			</thead>
												
			<tbody>
				<?php
				foreach($this->signaledComments as $signaled) {
				?>
					<tr>
						<td><strong><?= $signaled->getAuthor(); ?></strong></td>
						<td><em><?= $signaled->getContent(); ?></em></td>
						<td><?= $signaled->getDatePost()->format('d/m/y'); ?></td>
						<td>
							<a title="Valider le commentaire" href="?p=admin&amp;menu=comments&amp;action=validateComment&amp;commentId=<?= $signaled->getId(); ?>"><i class="fa fa-check" aria-hidden="true"></i></a> |  
							<a title="Supprimer le commentaire" href="?p=admin&amp;menu=comments&amp;action=deleteComment&amp;commentId=<?= $signaled->getId(); ?>"><i class="fa fa-ban" aria-hidden="true"></i></a></td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
		<?php
		}
		?>
	</div>
	<?php
}