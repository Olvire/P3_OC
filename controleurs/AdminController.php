<?php
class AdminController extends Controller
{
	public function execute()
	{
		$listArticles = $this->articleManager->get_list();
		$lastArticles = $this->articleManager->get_last_articles();
		$article = null;
		$selectedTab = 'dashboard';

		// GESTION DES ONGLETS DANS L'ESPACE D'ADMINISTRATION //
		if(isset($_GET['menu'])) {
			$selectedTab = $_GET['menu'];
		}

		// CRÉATION DES VARIABLES DE SESSION SI LE FORMULAIRE DE CONNEXION A ÉTÉ PRÉALABLEMENT REMPLI //
		if(isset($_POST['username']) AND $_POST['username'] == 'Jean' AND isset($_POST['password']) AND $_POST['password'] == '1234') {
		    $_SESSION['username'] = $_POST['username'];
		    $_SESSION['password'] = $_POST['password'];
		}

		// AJOUT ET MISE À JOUR D'UN ARTICLE EN BASE DE DONNÉES //
		if(!empty($_POST['title']) AND !empty($_POST['author']) AND !empty($_POST['content'])) {
			if(isset($_POST['id'])) {
				$this->articleManager->update($_POST['title'], $_POST['author'], $_POST['content'], $_POST['id']);
				$_SESSION['flash']['success'] = 'L\'article a bien été mis à jour !';
			} else {
				$this->articleManager->add($_POST['title'], $_POST['author'], $_POST['content']);
				$_SESSION['flash']['success'] = 'Réussi !';
			}
		}

		// ÉDITION ET SUPPRESSION DES ARTICLES //
		if(isset($_GET['action'])) {
			// Si la valeur de la superglobale 'action' est "delete", on supprime un article ayant pour ID l'id passé en URL.
			if($_GET['action'] == 'delete') 
			{
				$this->articleManager->delete_article($_GET['id']);
				header('Location: ?p=admin&menu=list');
				$_SESSION['flash']['success'] = 'L\'article a bien été supprimé !';
			} 
			// Si la valeur de la superglobale 'action' est "truncate", on supprime tous les articles de la base de données.
			elseif($_GET['action'] == 'truncate') 
			{
				$this->articleManager->delete_all();
				header('Location: ?p=admin&menu=settings');
				$_SESSION['flash']['success'] = 'Tous les articles ont été supprimés.';
			} 
			// Si la valeur de la superglobale 'action' est "edit", on modifie un article unique ayant pour ID l'id passé en URL.
			elseif($_GET['action'] == 'edit') 
			{
				$article = $this->articleManager->get_unique($_GET['id']);
			}
		}

		// TRANSMISSION DES INFORMATIONS À LA VUE //
		$viewAdmin = new ViewAdmin($listArticles, $lastArticles, $selectedTab, $article);
		$viewAdmin->display();
	}
}