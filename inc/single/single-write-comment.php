<div class="write-comment">
	<?php
	if(isset($_SESSION['username'])) {
		echo '<p>Vous postez un commentaire en tant que <strong>' . $_SESSION['username'] . '</strong></p>';
	}
	?>
	<form class="form-horizontal" action="index.php?p=single&amp;id=<?= $this->articleUnique->getId(); ?>#comments" method="post">
		<?php
		if(!isset($_SESSION['username'])) {
			?>
			<div class="form-group">
				<label for="pseudo" class="col-sm-1 control-label">Pseudo </label>
				<div class="col-sm-offset-1 col-sm-2">
					<input type="text" name="author" class="form-control" />
				</div>
			</div>
			<?php
		}
		?>

		<div class="form-group">
			<label for="contenu" class="col-sm-1 control-label">Commentaire </label>
				<div class="col-sm-offset-1 col-sm-10">
					<textarea name="content" class="form-control"></textarea>
				</div>
			</div>

		<input type="hidden" name="id" value="<?= $this->articleUnique->getId(); ?>">

		<input type="submit" class="btn btn-default" value="Envoyer">
	</form>
</div>