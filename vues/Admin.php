<?php

class ViewAdmin
{
	private $listOfArticles,
			$lastArticles,
			$selectedTab,
			$article,
			$signaledComments,
			$totalArticles,
			$totalComments,
			$listOfComments,
			$lastComments,
			$totalSignaledComments,
			$aboutDescription;

	public function __construct($listOfArticles, $lastArticles, $selectedTab, $article, $signaledComments, $totalArticles, $totalComments, $listOfComments, $lastComments, $totalSignaledComments, $aboutDescription) {
		$this->listOfArticles = $listOfArticles;
		$this->lastArticles = $lastArticles;
		$this->selectedTab = $selectedTab;
		$this->article = $article;
		$this->signaledComments = $signaledComments;
		$this->totalArticles = $totalArticles;
		$this->totalComments = $totalComments;
		$this->listOfComments = $listOfComments;
		$this->lastComments = $lastComments;
		$this->totalSignaledComments = $totalSignaledComments;
		$this->aboutDescription = $aboutDescription;
	}

	public function display() {
		?>
		<div class="admin-container">
			<div class="container">
			
			<?php
			// Si les variables de session ne sont pas créées, on affiche la page de connexion.
			if(!isset($_SESSION['username']) AND !isset($_SESSION['password'])) {
				include('../inc/admin/login.php');
			}
			elseif(isset($_SESSION['username']) AND $_SESSION['username'] !== 'Jean') {
				echo '<p>Désolé, vous n\'êtes pas autorisé à administrer ce blog.</p>';
			}
			// Sinon, on affiche les différents éléments composant l'espace d'administration.
			else {
				// Dans tous les cas, le menu de navigation composé de plusieurs onglets.
				include('../inc/admin/admin-nav.php');

				// Le tableau de bord si 'selectedTab' vaut 'dashboard'.
				if($this->selectedTab == 'dashboard') {
					include('../inc/admin/dashboard.php');
				}

				// La liste des articles.
				elseif($this->selectedTab == 'list') {
					if(count($this->listOfArticles) == 0) {
						echo '<p>Vous n\'avez pas encore publié d\'article. <a href="index.php?p=admin&amp;menu=write">Commencez ici</a></p>';
					} 
					else {
						include('../inc/admin/list-articles.php');
					}
				}

				// Le formulaire d'ajout ou d'édition d'article.
				elseif($this->selectedTab == 'write') {
					include('../inc/admin/write.php');
				}

				// La liste des commentaires.
				elseif($this->selectedTab == 'comments') {
					include('../inc/admin/comments.php');
				}

				// La liste des utilisateurs.
				elseif($this->selectedTab == 'users') {
					include('../inc/admin/users.php');
				}

				// Les réglages
				elseif($this->selectedTab == 'settings') {
					include('../inc/admin/settings.php');
				}
			}
			?>
			</div>
		</div>
		<?php
	}
}