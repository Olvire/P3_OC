<?php

class SingleController extends Controller {
	public function execute() {
		// Si $_POST['author'] n'est pas vide OU qu'il est vide mais que $_SESSION['username'] existe et que $_POST['content'] n'est pas vide
		if(!empty($_POST['author']) OR (empty($_POST['author']) AND isset($_SESSION['username']) AND !empty($_POST['content']))) {
			$comment = new Comment();
			$comment->setArticleId($_GET['id']);
			if(isset($_SESSION['username'])) {
				$comment->setAuthor($_SESSION['username']);
			} else {
				$comment->setAuthor($_POST['author']);
			}
			$comment->setContent($_POST['content']);
			if(isset($_POST['parentId'])) {
				$comment->setParentId($_POST['parentId']);
			}
			$this->commentManager->add($comment);
			$_SESSION['flash']['success'] = 'Votre commentaire a bien été ajouté.';
		}

		// Signalement d'un commentaire.
		if(isset($_GET['action'])) {
			if($_GET['action'] == 'signal') {
				$comment = $this->commentManager->getSpecificComment($_GET['commentId']);
				$this->commentManager->signal($comment);
				$_SESSION['flash']['success'] = 'Le commentaire a bien été signalé. Il sera modéré par l\'administrateur dès que possible.';
			}
		}

		// Les 5 derniers articles publiés et un article spécifique.
		$lastArticles = $this->articleManager->getLastArticles();
		$articleUnique = $this->articleManager->getUnique($_GET['id']);
		// Liste des commentaires de l'article courant et total de ses commentaires.
		$listOfComments = $this->commentManager->getComments($_GET['id']);
		$numberOfComments = $this->commentManager->count($_GET['id']);

		$viewSingle = new ViewSingle($articleUnique, $listOfComments, $numberOfComments, $lastArticles);
		$viewSingle->display();
	}
}