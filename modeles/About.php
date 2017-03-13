<?php

class About {
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

	public function setId($id) {
		if($id > 0) {
			$this->id = $id;
		}
	}

	public function setDescription($description) {
		if(is_string($description)) {
			$this->description = $description;
		}
	}

	public function getId() {
		return $this->id;
	}

	public function getDescription() {
		return $this->description;
	}
}