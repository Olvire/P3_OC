<?php

class SingleController extends Controller
{
	public function execute()
	{
		// Si les superglobales 'author' et 'content' sont remplies, on ajout le commentaire à la BDD.
		if(!empty($_POST['author']) AND !empty($_POST['content'])) {
			$this->commentManager->add($_POST['author'], $_GET['id'], $_POST['content']);
		}

		// Si la superglobale 'action' existe et qu'elle vaut 'signal', on met à jour le champ 'signaler' de la BDD.
		if(isset($_GET['action']) AND $_GET['action'] == 'signal')
		{
			$this->commentManager->update_signal($_GET['comment_id']);
		}

		// L'article unique.
		$articleUnique = $this->articleManager->get_unique($_GET['id']);

		// Liste des commentaires de l'article courant.
		$listeCommentaires = $this->commentManager->get_comments($_GET['id']);

		// Total de commentaire sur l'article courant.
		$nb = $this->commentManager->count($_GET['id']);

		// Les 5 derniers articles publiés sur le blog.
		$lastArticles = $this->articleManager->get_last_articles();

		// Passés à la vue : un article unique, la liste de ses commentaires, le nombre de commentaires de l'articles, ainsi qu'une liste des 5 derniers articles publiés sur le blog pour affichage dans <aside>.
		$viewSingle = new ViewSingle($articleUnique, $listeCommentaires, $nb, $lastArticles);
		$viewSingle->display();
	}
}