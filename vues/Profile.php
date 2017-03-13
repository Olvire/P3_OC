<?php

class Profile {
	public function display() {
		?>
		
		<div class="profile-container">
			<div class="container">
				<div class="row">
					<!-- Left: photo -->
					<div class="col-xs-12 col-md-4">
						<div class="page-header">
							<img class="profile-picture" src="../public/img/empty.jpg" alt="Empty profile picture">
						</div>
					</div>
					
					<!-- Right: profile -->
					<div class="col-xs-12 col-md-8">
						<div class="page-header">
							<h3>Mon profil</h3>
						</div>
						
						<p>Votre pseudo : <strong><?= $_SESSION['username']; ?></strong></p>
						<p>Votre adresse e-mail : <strong>jeanforteroche@test.fr</strong> <i class="fa fa-pencil" aria-hidden="true"></i></p>
						<button class="btn btn-default btn-sm" type="button">Modifier mon mot de passe</button>
					</div>
				</div>
			</div>
		</div>

		<?php
	}
}