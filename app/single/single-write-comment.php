<div class="write-comment">
	<form class="form-horizontal" action="index.php?p=single&amp;id=<?= $this->articleUnique->get_id(); ?>" method="post">
		<div class="form-group">
			<label for="pseudo" class="col-sm-1 control-label">Pseudo </label>
			<div class="col-sm-offset-1 col-sm-2">
				<input type="text" name="author" class="form-control" value="">
			</div>
		</div>

		<div class="form-group">
			<label for="contenu" class="col-sm-1 control-label">Commentaire </label>
				<div class="col-sm-offset-1 col-sm-10">
					<textarea name="content" class="form-control"></textarea>
				</div>
			</div>

		<input type="submit" class="btn btn-default" value="Envoyer">
	</form>
</div>