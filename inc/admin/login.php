<div class="row">
	<div class="col-xs-12 col-md-offset-2 col-md-8 col-md-offset-2">
		<div class="page-header">
			<h2>Connexion à l'espace d'administration</h2>
		</div>


		<?php

		$loginForm = new LoginForm();

		echo '<form action="index.php?p=admin" method="post">';
		echo $loginForm->usernameField();
		echo $loginForm->passwordField();
		echo $loginForm->submit();
		echo '</form><br>';
		echo '<a href="index.php"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Retour à la page d\'accueil</a>';
		?>
		
		<br><br>

		<div class="alert alert-warning">
			<p class="text-justify">Pour le moment, seul l'administrateur est autorisé à se connecter. L'éventualité d'une inscription et d'une connexion pour tous les visiteurs est possible dans d'éventuelles futures mises à jour.</p>
		</div>
	</div>
</div>