<?php
/**
 * Classe pour About
 */
class About {
	
	// Attributs nécessaires.
	private $id;
	private $description;

	public function __construct($value = []) {
		if(!empty($value)) {
			$this->hydrate($value);
		}
	}

	public function hydrate($data) {
		foreach($data as $key => $value) {
			$method = 'set'.ucfirst($key);
			if(method_exists([$this, $method])) {
				$this->$method($value);
			}
		}
	}

	// SETTERS //

	/**
	 * Permet d'assigner une valeur à l'attribut 'id'.
	 * @param int $id L'id.
	 */
	public function setId($id) {
		if($id > 0) {
			$this->id = $id;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'description'.
	 * @param string $description La description.
	 */
	public function setDescription($description) {
		if(is_string($description) AND !empty($description)) {
			$this->description = $description;
		}
	}

	// GETTERS //

	/**
	 * Obtient la valeur de l'attribut 'id'.
	 * @return int L'id.
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Obtient la valeur de l'attribut 'description'.
	 * @return string La description.
	 */
	public function getDescription() {
		return $this->description;
	}
}