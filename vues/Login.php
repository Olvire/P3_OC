<?php
class ViewLogin {
	public function display() {

		if(isset($_POST['password'])) {
			$password = $_POST['password'];
			$pass_hache = sha1($password);
		}
		if(isset($_POST['pseudo'])) {
			$pseudo = $_POST['pseudo'];
		}

		?>

		<div class="login-container">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-5">
						<div class="page-header">
							<h3>Connexion</h3>
						</div>

						<form class="form-horizontal text-center" action="traitement.php" method="post">
							<div class="form-group">
								<label for="pseudo">Pseudo</label>
								<input type="text" name="pseudo" class="form-control" required />
							</div>

							<div class="form-group">
								<label for="password">Mot de passe</label>
								<input type="password" name="password" class="form-control" required />
							</div>

							<label for="auto_connexion">Connexion automatique</label>
							<input type="checkbox" name="auto_connexion" /><br><br>

							<input type="submit" value="Se connecter" class="btn btn-primary">
						</form>
					</div>
					
					<div class="col-xs-12 col-md-offset-1 col-md-5">
						<div class="page-header">
							<h3>Inscription</h3>
						</div>

						<form class="form-horizontal text-center" action="traitement.php" method="post">
							<div class="form-group">
								<label for="pseudo">Pseudo</label>
								<input type="text" name="pseudo" class="form-control" required />
							</div>

							<div class="form-group">
								<label for="password">Mot de passe</label>
								<input type="password" name="password" class="form-control" required />
							</div>

							<div class="form-group">
								<label for="repass">Confirmez le mot de passe</label>
								<input type="password" name="repass" class="form-control" required />
							</div>

							<div class="form-group">
								<label for="email">Adresse email</label>
								<input type="email" name="email" class="form-control" required />
							</div>

							<input type="submit" value="M'inscrire" class="btn btn-primary">
						</form>
					</div>
				</div>	
			</div>
		</div>

		<?php
	}
}