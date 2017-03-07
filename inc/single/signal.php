<?php
if($subComment->getSignaler() == 0) {
?>
<small>
	<a class="btn btn-danger btn-xs pull-right" title="Signaler le commentaire" href="index.php?p=single&id=<?= $this->articleUnique->getId(); ?>&action=signal&commentId=<?= $subComment->getId(); ?>">!</a>
</small>
<?php
} else {
?>
<small class="text-danger pull-right">Ce commentaire a été signalé et est en attente de modération.</small>
<?php
}
?>