<?php
class User {
	private $id;
	private $username;
	private $password;
	private $email;
	private $dateInscription;

	public function __construct($values = []) {
		if(!empty($values)) {
			$this->hydrate($values);
		}
	}

	public function hydrate($data) {
		foreach($data as $key => $value) {
			$method = 'set'.ucfirst($key);

			if(method_exists([$this, $methode])) {
				$this->$method($value);
			}
		}
	}

	// SETTERS //
	public function setId($id) {
		if(is_int($id) AND $id > 0) {
			$this->id = $id;
		}
	}

	public function setUsername($username) {
		if(is_string($username) AND !empty($username)) {
			$this->username = $username;
		}
	}

	public function setPassword($password) {
		if(is_string($password) AND !empty($password)) {
			$this->password = $password;
		}
	}

	public function setEmail($email) {
		if(!empty($email) AND filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->email = $email;
		}
	}

	// GETTERS //
	public function getErrors() { return $this->errors; }
	public function getId() { return $this->id; }
	public function getUsername() { return $this->username; }
	public function getPassword() { return $this->password; }
	public function getEmail() { return $this->email; }
	public function getDateInscription() { return $this->dateInscription; }
}