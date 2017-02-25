<?php
class User {
	private $erreurs = [];
	private $id;
	private $username;
	private $password;
	private $email;

	const USERNAME_INVALIDE = 1;
	const PASSWORD_INVALIDE = 2;
	const EMAIL_INVALIDE = 3;

	public function __construct($valeurs = []) {
		if(!empty($valeurs)) {
			$this->hydrate($valeurs);
		}
	}

	public function hydrate($donnees) {
		foreach($donnees as $attribut => $valeur) {
			$methode = 'set_' . ucfirst($attribut);

			if(method_exists([$this, $methode])) {
				$this->$methode($valeur);
			}
		}
	}

	public function is_new() {
		return empty($this->id);
	}

	public function is_valid() {
		return !(empty($this->username) OR empty($this->password) OR empty($this->email));
	}

	// SETTERS //
	public function set_id($id) {
		if(is_int($id) AND $id > 0) {
			$this->id = $id;
		}
	}

	public function set_username($username) {
		if(!is_string($username) OR empty($username) !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
			$this->erreurs[] = self::USERNAME_INVALIDE;
		} else {
			$this->username = $username;
		}
	}

	public function set_password($password) {
		if(!is_string($password) OR empty($password)) {
			$this->erreurs[] = self::PASSWORD_INVALIDE;
		} else {
			$this->password = $password;
		}
	}

	public function set_email($email) {
		if(empty($email) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->erreurs[] = self::EMAIL_INVALIDE;
		} else {
			$this->email = $email;
		}
	}

	// GETTERS //
	public function get_erreurs() {
		return $this->erreurs;
	}

	public function get_id() {
		return $this->id;
	}

	public function get_username() {
		return $this->username;
	}

	public function get_password() {
		return $this->password;
	}

	public function get_email() {
		return $this->email;
	}
}