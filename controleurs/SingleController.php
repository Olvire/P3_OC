<?php

class SingleController extends Controller
{
	public function execute()
	{
		// Vérifications pour l'ajout d'un commentaire.
		if(!empty($_POST['author']) AND !empty($_POST['content'])) {
			$this->commentManager->add($_POST['author'], $_GET['id'], $_POST['content']);
		}

		$articleUnique = $this->articleManager->get_unique($_GET['id']);
		$listeCommentaires = $this->commentManager->get_comments($_GET['id']);
		$nb = $this->commentManager->count($_GET['id']);

		$lastArticles = $this->articleManager->get_last_articles();

		$viewSingle = new ViewSingle($articleUnique, $listeCommentaires, $nb, $lastArticles);
		$viewSingle->display();
	}
}