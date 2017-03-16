<?php
/**
 * Classe qui modélise le contrôleur de la vue Profile
 */
class ProfileController extends Controller {
	
	/**
	 * Crée une vue et active sa méthode display.
	 */
	public function execute() {
		$viewProfile = new ViewProfile();
		$viewProfile->display();
	}

}