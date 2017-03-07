<?php
class LoginForm
{
	private $surround = 'form-group';

	public function surround($html)
	{
		return "<div class=\"{$this->surround}\">{$html}</div>";
	}

	public function usernameField() 
	{
		return $this->surround('<label for="username">Nom d\'utilisateur </label> <input class="form-control" type="text" name="username" id="username" />');
	}

	public function passwordField()
	{
		return $this->surround('<label for="password">Mot de passe </label> <input class="form-control" type="password" name="password" id="password" />');
	}

	/**
	 * @return string The submit button
	 */
	public function submit()
	{
		return '<button type="submit" class="btn btn-primary">Connexion</button>';
	}

}