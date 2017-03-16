<?php
/**
 * Classe pour Comment
 */
class Comment
{	

	// Attributs nécessaires
	private $id;
	private $articleId;
	private $parentId = 0;
	private $content;
	private $datePost;
	private $author;
	private $signaler;
	private $subComments = array();

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

	/**
	 * Permet d'ajouter un sous-commentaire.
	 * @param Comment $subComment Le sous-commentaire
	 */
	public function addSubComment(Comment $subComment) {
		$this->subComments[] = $subComment;
	}

	// SETTERS //
	
	/**
	 * Permet d'assigner une valeur à l'attribut 'id'.
	 * @param int $id L'id
	 */
	public function setId($id) {
		if(is_int($id) AND $id > 0) {
			$this->id = $id;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'articleId'.
	 * @param int $articleId L'id de l'article
	 */
	public function setArticleId($articleId) {
		$this->articleId = (int) $articleId;
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'parentId'.
	 * @param int $parentId L'id parent
	 */
	public function setParentId($parentId) {
		if($parentId >= 0) {
			$this->parentId = $parentId;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'content'.
	 * @param string $content Le contenu
	 */
	public function setContent($content) {
		if(is_string($content) AND !empty($content)) {
			$this->content = $content;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'datePost'.
	 * @param DateTime $datePost La date de publication
	 */
	public function setDatePost(DateTime $datePost) {
		$this->datePost = $datePost;
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'author'.
	 * @param string $author L'auteur
	 */
	public function setAuthor($author) {
		if(is_string($author) AND !empty($author)) {
			$this->author = $author;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'signaler'.
	 * @param int $signaler Le signal
	 */
	public function setSignaler($signaler) {
		if(is_int($signaler) AND !empty($signaler)) {
			$this->signaler = $signaler;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'subComments'.
	 * @param $subComments Le sous-commentaire
	 */
	public function setSubComments($subComments) {
		$this->subComments = $subComments;
	}
	
	// GETTERS //
	
	/**
	 * Obtient l'id du commentaire.
	 * @return int L'id du commentaire
	 */
	public function getId() {
		return $this->id; 
	}

	/**
	 * Obtient l'id de l'article.
	 * @return int L'id de l'article
	 */
	public function getArticleId() {
		return $this->articleId; 
	}

	/**
	 * Obtient l'id du commentaire parent.
	 * @return int L'id du commentaire parent
	 */
	public function getParentId() {
		return $this->parentId; 
	}

	/**
	 * Obtient le contenu du commentaire.
	 * @return string Le contenu
	 */
	public function getContent() {
		return $this->content; 
	}

	/**
	 * Obtient la date de publication du commentaire.
	 * @return DateTime Object La date de publication
	 */
	public function getDatePost() {
		return $this->datePost; 
	}

	/**
	 * Obtient l'auteur du commentaire.
	 * @return string L'auteur
	 */
	public function getAuthor() {
		return $this->author; 
	}

	/**
	 * Obtient la valeur de l'attribut 'Signaler'.
	 * @return int Le signal
	 */
	public function getSignaler() {
		return $this->signaler; 
	}

	/**
	 * Obtient le sous-commentaire.
	 * @return Comment Object Le sous-commentaire.
	 */
	public function getSubComments() {
		return $this->subComments; 
	}

}