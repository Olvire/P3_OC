<?php
class AdminController extends Controller {
	public function execute() {
		
		$selectedTab = 'dashboard';

		$article = null;	

		// GESTION DES ONGLETS DANS L'ESPACE D'ADMINISTRATION //
		if(isset($_GET['menu'])) {
			$selectedTab = $_GET['menu'];
		}

		// AJOUT ET MISE À JOUR D'UN ARTICLE EN BASE DE DONNÉES //
		if(!empty($_POST['title']) AND !empty($_POST['author']) AND !empty($_POST['content'])) {
			$title = $_POST['title'];
			$author = $_POST['author'];
			$content = $_POST['content'];

			$id = (!empty($_POST['id']) ? $_POST['id'] : NULL);

			if(isset($_POST['id'])) {
				$this->articleManager->update($title, $author, $content, $id);
			} else {
				$article = new Article();
				$article->setTitle($title);
				$article->setContent($content);
				$article->setAuthor($author);
				$this->articleManager->add($article);
			}
		}

		// ÉDITION ET SUPPRESSION DES ARTICLES //
		if(isset($_GET['action'])) {
			if($_GET['action'] == 'delete') {
				$this->articleManager->deleteArticle();
			} elseif($_GET['action'] == 'truncate') {
				$this->articleManager->deleteAll();
				$this->commentManager->deleteAll();
			} elseif($_GET['action'] == 'edit') {
				$article = $this->articleManager->getUnique($_GET['id']);
			}
		}

		// GESTION DES COMMENTAIRES
		if(isset($_GET['action'])) {
			if($_GET['action'] == 'validateComment') {
				$this->commentManager->validateComment($_GET['commentId']);
			} elseif($_GET['action'] == 'deleteComment') {
				$this->commentManager->deleteComment($_GET['commentId']);
			} elseif($_GET['action'] == 'deleteAllComments') {
				$this->commentManager->deleteAll();
			}
		}

		// Personnalisation page 'About.php'
		if(isset($_POST['aboutDescription'])) {
			if(empty($this->aboutManager->getDescription())) {
				$about = new About();
				$about->setDescription($_POST['aboutDescription']);
				$this->aboutManager->add($about);
			} else {
				$this->aboutManager->update($_POST['aboutDescription'], 1);
			}
		}
		if(isset($_GET['action']) AND $_GET['action'] == 'deleteDescription') {
			$this->aboutManager->deleteDescription();
		}

		// Liés aux articles
		$listOfArticles = $this->articleManager->getList();
		$lastArticles = $this->articleManager->getLastArticles();
		$totalArticles = $this->articleManager->count();

		// Liés aux commentaires
		$listOfComments = $this->commentManager->getAllComments();
		$lastComments = $this->commentManager->getLastComments();
		$totalComments = $this->commentManager->getTotalCount();
		$signaledComments = $this->commentManager->getSignaledComments();
		$totalSignaledComments = $this->commentManager->countSignaledComments();

		// Lié à la page About.php
		$aboutDescription = $this->aboutManager->getDescription();
		
		// TRANSMISSION DES INFORMATIONS À LA VUE //
		$viewAdmin = new ViewAdmin($listOfArticles, $lastArticles, $selectedTab, $article, $signaledComments, $totalArticles, $totalComments, $listOfComments, $lastComments, $totalSignaledComments, $aboutDescription);
		$viewAdmin->display();
	}
}