<?php
/**
 * Class for view admin.
 */
class ViewAdmin
{
	private $listArticles;
	private $lastArticles;
	private $selectedTab;
	private $article;

	public function __construct($listArticles, $lastArticles, $selectedTab, $article)
	{
		$this->listArticles = $listArticles;
		$this->lastArticles = $lastArticles;
		$this->selectedTab = $selectedTab;
		$this->article = $article;
	}

	public function display()
	{	
		?>
		<div class="admin-container">
			<div class="container">
			<?php
			// Si les variables de session n'existent pas, on affiche le formulaire de connexion.
			if(!isset($_SESSION['username']) AND !isset($_SESSION['password'])) {
				?>
				<h2>Connexion à l'espace d'administration</h2>
				<hr>
				<?php
				$loginForm = new LoginForm();
				echo '<form action="index.php?p=admin" method="post">';
				echo $loginForm->username_field();
				echo $loginForm->password_field();
				echo $loginForm->submit();
				echo '</form><br>';
				echo '<a href="index.php"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Retour à la page d\'accueil</a>';
			} 
			// Si les variables existent, on affiche l'espace d'administration complet.
			else {
				?>
				<!-- Menu de navigation de la zone d'administration. -->
				<ul class="nav nav-tabs admin-nav">
					<li role="presentation" <?php if($this->selectedTab == 'dashboard') echo 'class="active"' ?>>
						<a href="index.php?p=admin">Tableau de bord</a>
					</li>
					<li role="presentation" <?php if($this->selectedTab == 'list') echo 'class="active"' ?>>
						<a href="index.php?p=admin&amp;menu=list">Mes articles</a>
					</li>
					<li role="presentation" <?php if($this->selectedTab == 'write')  echo 'class="active"' ?>>
						<a href="index.php?p=admin&amp;menu=write">Écrire</a>
					</li>
					<li role="presentation" <?php if($this->selectedTab == 'comments') echo 'class="active"' ?>>
						<a href="index.php?p=admin&amp;menu=comments">Commentaires</a>
					</li>
					<li role="presentation" <?php if($this->selectedTab == 'settings') echo 'class="active"' ?>>
						<a href="index.php?p=admin&amp;menu=settings">Réglages</a>
					</li>
				</ul>
				<?php
				// Affichage du tableau de bord à la condition que $_GET['menu'] n'existe pas ou soit vide.
				if($this->selectedTab == 'dashboard')
				{
					include('../app/admin/admin-dashboard.php');
				}

				// Si la superglobale 'menu' existe...
				if($this->selectedTab) 
				{
					// ... et que 'menu' == 'list' :
					if($this->selectedTab == 'list') 
					{
						if(count($this->listArticles) == 0) 
						{
							echo '<p>Vous n\'avez pas encore publié d\'article. <a href="index.php?p=admin&amp;menu=write">Commencez ici</a></p>';
						} 
						else 
						{
							include('../app/admin/admin-list-articles.php');
						}
					}

					// ... et que 'menu' == 'write' :
					if($this->selectedTab == 'write')
					{
						include('../app/admin/admin-write.php');
					}

					// ... et que 'menu' == 'comments' :
					if($this->selectedTab == 'comments')
					{
					?>
					<h3>Commentaires</h3>
					<br>
					<p>Soon...</p>
					<?php
					}

					// ... et que 'menu' == 'settings' :
					if($this->selectedTab == 'settings') 
					{
					?>
					<h3>Réglages</h3>
					<hr>
					<h4>Votre blog</h4>
					<br>
					<form action="" method="post">
						<div class="form-group">
							<label for="about">À propos</label>
							<textarea name="about" id="" class="form-control" placeholder="Vous pouvez rédiger ici une présentation de vous-même."></textarea>
						</div>

						<input type="submit" class="btn btn-primary" value="Envoyer">
					</form>

					<hr>

					<h4>Votre compte</h4>
					<?php
					// Messages flash quand des actions sont effectuées
					include '../app/flash-msg.php';
					?>
					<p><a href="index.php?p=admin&amp;action=truncate" class="btn btn-danger">Supprimer tous les articles</a></p>
					<p><a href="../app/logout.php" class="btn btn-danger">Déconnexion</a></p>

					<hr>

					<h4>Votre base de données</h4>

					<p>Permet de consulter la base de données grâce à phpMyAdmin.</p>
					<a href="http://localhost:8888/phpMyAdmin/" target="_blank" class="btn btn-success">Consulter</a>
					<?php
					}
				}
			}
			?>
			</div>
		</div>
		<?php
	}
}