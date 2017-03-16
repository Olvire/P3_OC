<?php
/**
 * Classe pour le formulaire de connexion
 */
class LoginForm
{
	private $surround = 'form-group';

	/**
	 * Se charge d'entourer les champs d'une div ayant pour classe le contenu de l'attribut 'surround'.
	 * @param html $html Le champ devant être entouré
	 * @return ligne de code HTML
	 */
	public function surround($html) {
		return "<div class=\"{$this->surround}\">{$html}</div>";
	}

	/**
	 * Crée un champ de type 'text' pour le nom d'utilisateur.
	 */
	public function usernameField() {
		return $this->surround('<label for="username">Nom d\'utilisateur </label> <input class="form-control" type="text" name="username" id="username" />');
	}

	/**
	 * Crée un champ de type 'password' pour le mot de passe.
	 */
	public function passwordField() {
		return $this->surround('<label for="password">Mot de passe </label> <input class="form-control" type="password" name="password" id="password" />');
	}

	/**
	 * Crée un bouton de type 'submit' pour soumettre le formulaire.
	 */
	public function submit() {
		return '<button type="submit" class="btn btn-primary">Connexion</button>';
	}

}