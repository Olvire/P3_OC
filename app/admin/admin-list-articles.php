<h3>Liste d'articles</h3>
<br>
<?php

// Messages flash quand des actions sont effectuées
include '../app/flash-msg.php';

?>
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<th class="col-xs-3">Titre</th>
		<th class="col-xs-3">Extrait</th>
		<th class="col-xs-3">Posté le</th>
		<th class="col-xs-3">Modifié le</th>
	</thead>
						
	<tbody>
	<?php
	foreach($this->listArticles as $article) {
	?>
	<tr>
		<td>
			<strong><?= htmlspecialchars($article->get_title()); ?></strong>
			<div class="edit-delete-buttons">

				<small><a title="Ouvrir dans un nouvel onglet" href="index.php?p=single&amp;id=<?= $article->get_id() ?>" target="_blank"><i class="fa fa-book fa-lg book" aria-hidden="true"></i></a></small>

				<small><a title="Modifier" href="index.php?p=admin&amp;menu=write&amp;action=edit&amp;id=<?= $article->get_id(); ?>"><i class="fa fa-pencil fa-lg pen" aria-hidden="true"></i></a></small>

				<small><a title="Supprimer" href="index.php?p=admin&amp;action=delete&amp;id=<?= $article->get_id(); ?>"><i class="fa fa-trash-o fa-lg trash" aria-hidden="true"></i></a></small>

			</div>
		</td>

		<td><?= substr($article->get_content(), 0, 150) . '...'; ?></td>
		<td><?= $article->get_date_post()->format('j.m.Y à H:i:s'); ?></td>
		<td>
			<?php
			if($article->get_date_edit()->format('j.m.Y') == '30.11.-0001') {
				echo '-';
			} else {
				echo $article->get_date_edit()->format('j.m.Y à H:i:s');
			}
			?>
		</td>
	</tr>
	<?php
	}
	?>
	</tbody>
</table>