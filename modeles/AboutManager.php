<?php
/**
 * Classe servant de Manager à la classe About
 */
class AboutManager {

	// Attribut nécessaire à la connexion avec la base de données.
	private $db;

	/**
	 * Permet de se connecter à la base de données dès l'instanciation de l'objet.
	 * @param PDO Object $db La base de données
	 */
	public function __construct($db)
	{
		$this->db = $db;
	}

	/**
	 * Permet d'ajouter un objet About (description) en base de données.
	 * @param string $about L'objet About
	 */
	public function add(About $about) {
		$req = $this->db->prepare('INSERT INTO about (description) VALUES (:description)');
		$req->bindValue(':description', $about->getDescription());
		
		$req->execute();
	}

	/**
	 * Permet de mettre à jour la valeur de l'objet About en base de données.
	 * @param string $about L'objet About
	 */
	public function update($description, $id) {
		$req = $this->db->prepare('UPDATE about SET description = :description WHERE id = :id');
		$req->bindValue(':description', $description);
		$req->bindValue(':id', (int) $id);
		$req->execute();
	}

	/**
	 * Obtient la description pour affichage en vue.
	 * @return string La description.
	 */
	public function getDescription() {
		$res = $this->db->query('SELECT * FROM about WHERE id = 1')->fetchColumn(1);
		return $res;
	}

	public function deleteDescription() {
		$res = $this->db->exec('TRUNCATE TABLE about');
		return $res;
	}
}