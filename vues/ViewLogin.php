<?php

class ViewLogin {

	public function display() {
		?>
		
		<div class="login-container">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-offset-3 col-md-6 col-md-offset-3">
						<div class="page-header">
							<h3 class="text-center">Connexion à l'administration</h3>
						</div>

						<div class="login-form">
							<img class="img-login img-responsive" src="../public/img/login.png" alt="">
							<form action="" method="post">
								<p>
									<label for="username">Nom d'utilisateur </label>
									<input class="form-control" type="text" name="username" required />
								</p>
									
								<p>
									<label for="password">Mot de passe </label>
									<input class="form-control" type="password" name="password" required />
								</p>
								<p>
									<input type="checkbox">
									<label for="auto-co">Se souvenir de moi </label>
								</p>

								<p class="text-center">
									<input class="btn btn-default" type="submit" value="Connexion" />
								</p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
	}

}