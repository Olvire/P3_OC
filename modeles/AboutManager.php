<?php

class AboutManager {
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	// À vérifier
	public function add(About $about)
	{
		$req = $this->db->prepare('INSERT INTO about(description) VALUES(:description)');
		$req->bindValue(':description', $about->getDescription());
		$req->execute();
	}

	// À vérifier
	public function update(About $about) {
		$req = $this->db->prepare('UPDATE about SET description = :description WHERE id = :id');
		$req->bindValue(':description', $about->getDescription());
		$req->bindValue(':id', $about->getId());
		$req->execute();
	}

	// À vérifier
	public function getDescription() {
		$res = $this->db->query('SELECT * FROM about WHERE id = 1')->fetchColumn(1);
		return $res;
	}
}