<?php

class UserManager {

	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function addUser(User $user) {
		$req = $this->db->prepare('INSERT INTO users(username, password, email, role, date_inscription) VALUES(:username, :password, :email, :role, NOW())');
		$req->bindValue(':username', $user->getUsername());
		$req->bindValue(':password', $user->getPassword());
		$req->bindValue(':email', $user->getEmail());
		$req->bindValue(':role', $user->getRole());

		$req->execute();
	}

	public function count() {
		$result = $this->db->query('SELECT * FROM users')->fetchColumn();
		return $result;
	}
}