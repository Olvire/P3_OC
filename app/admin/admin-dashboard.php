<div class="row">
	<div class="col-xs-12 col-sm-3 articles-nb">
		<h2>Publications</h2>
		<h3><?= $this->totalArticles; ?></h3>
	</div>
	<div class="col-xs-12 col-sm-offset-1 col-sm-4 comments-nb">
		<h2>Commentaires</h2>
		<h3><?= $this->totalComments; ?></h3>

	</div>
	<div class="col-xs-12 col-sm-offset-1 col-sm-3 users-nb">
		<h2>Utilisateurs</h2>
		<h3>0</h3>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-xs-12">
		<?php
		// Messages flash quand des actions sont effectuées
		include '../app/flash-msg.php';
		?>
		<h3>Commentaires signalés</h3>
		<?php 
		if(empty($this->signaledComments)) 
		{
			echo 'Aucun commentaire n\'a été signalé pour le moment.';
		}
		else
		{
		?>
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead>
				<th>Auteur</th>
				<th>Contenu</th>
				<th>Le</th>
				<th>Signalé</th>
				<th>Action</th>
			</thead>
								
			<tbody>
			<?php
			foreach($this->signaledComments as $signaled) {
			?>
			<tr>
				<td><strong><?= $signaled->get_author(); ?></strong></td>
				<td><em><?= $signaled->get_content(); ?></em></td>
				<td><?= $signaled->get_date_post()->format('d/m/y'); ?></td>
				<td><?= $signaled->get_signaler(); ?> fois</td>
				<td><a href="?p=admin&amp;action=validate_comment&amp;comment_id=<?= $signaled->get_id(); ?>">V</a> | <a href="index.php?p=single&amp;id=<?= $signaled->get_article_id(); ?>&amp;action=edit_comment&amp;signaled_id=<?php $signaled->get_id(); ?>">M</a> | <a href="?p=admin&amp;action=remove_comment&amp;id=<?= $signaled->get_id(); ?>">S</a></td>
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
</div>