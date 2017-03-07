<?php

class LoginManager {

	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function addUser(User $user) {
		$req = $this->db->prepare('INSERT INTO users(username, password, email, date_inscription) VALUES(:username, :password, :email, NOW()');
	}

}