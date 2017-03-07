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