<?php
/**
 * Classe pour LoginController
 */
class LoginController extends Controller {

	public function execute() {

		// Si les superglobales 'username' et 'password' sont corrects
		// la variable de session 'username' est créée.
		if(isset($_POST['username']) AND $_POST['username'] == 'Jean' AND isset($_POST['password']) AND $_POST['password'] == 'forteroche') {
			$_SESSION['username'] = $_POST['username'];
			// Redirection vers la page d'accueil.
			header('Location: ../public/index.php?p=admin');
		}

		$viewLogin = new ViewLogin();
		$viewLogin->display();

	}

}