<?php
/**
 * Classe pour Article
 */
class Article
{
	// Attributs nécessaires.
	private $id;
	private $title;
	private $content;
	private $author;
	private $datePost;
	private $dateEdit;

	public function __construct($value = [])
	{
		if(!empty($value))
		{
			$this->hydrate($value);
		}
	}

	public function hydrate($data)
	{
		foreach($data as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			if(method_exists([$this, $method]))
			{
				$this->$method($value);
			}
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'id'.
	 * @param int $id L'id
	 */
	public function setId($id)
	{
		if(is_int($id) AND $id > 0)
		{
			$this->id = $id;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'title'.
	 * @param string $title Le titre
	 */
	public function setTitle($title)
	{
		if(is_string($title) AND !empty($title)) {
			$this->title = $title;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'content'.
	 * @param string $content Le contenu
	 */
	public function setContent($content)
	{
		if(is_string($content) AND !empty($content)) 
		{
			$this->content = $content;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'author'.
	 * @param string $content L'auteur
	 */
	public function setAuthor($author)
	{
		if(is_string($author) AND !empty($author)) 
		{
			$this->author = $author;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'datePost'.
	 * @param DateTime $datePost La date de publication
	 */
	public function setDatePost(DateTime $datePost)
	{
		$this->datePost = $datePost;
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'dateEdit'.
	 * @param DateTime $dateEdit La date d'édition
	 */
	public function setDateEdit(DateTime $dateEdit)
	{
		$this->dateEdit = $dateEdit;
	}

	// GETTERS //

	/**
	 * Obtient l'id de l'article.
	 * @return int L'id
	 */
	public function getId() {
		return $this->id; 
	}

	/**
	 * Obtient le titre de l'article.
	 * @return string Le titre
	 */
	public function getTitle() {
		return $this->title; 
	}

	/**
	 * Obtient le contenu de l'article.
	 * @return string Le contenu
	 */
	public function getContent() {
		return $this->content; 
	}

	/**
	 * Obtient l'auteur de l'article.
	 * @return string L'auteur
	 */
	public function getAuthor() {
		return $this->author; 
	}

	/**
	 * Obtient la date de publication de l'article.
	 * @return DateTime Object La date de publication
	 */
	public function getDatePost() {
		return $this->datePost; 
	}

	/**
	 * Obtient la date d'édition de l'article.
	 * @return DateTime Object La date d'édition
	 */
	public function getDateEdit() {
		return $this->dateEdit;
	}
}