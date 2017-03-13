<?php
class Article
{
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

	public function setId($id)
	{
		if(is_int($id) AND $id > 0)
		{
			$this->id = $id;
		}
	}

	public function setTitle($title)
	{
		if(is_string($title) AND !empty($title)) {
			$this->title = $title;
		}
	}

	public function setContent($content)
	{
		if(is_string($content) AND !empty($content)) 
		{
			$this->content = $content;
		}
	}

	public function setAuthor($author)
	{
		if(is_string($author) AND !empty($author)) 
		{
			$this->author = $author;
		}
	}

	public function setDatePost(DateTime $datePost)
	{
		$this->datePost = $datePost;
	}

	public function setDateEdit(DateTime $dateEdit)
	{
		$this->dateEdit = $dateEdit;
	}

	// GETTERS //
	public function getErrors() { return $this->errors; }
	public function getId() { return $this->id; }
	public function getTitle() { return $this->title; }
	public function getContent() { return $this->content; }
	public function getAuthor() { return $this->author; }
	public function getDatePost() { return $this->datePost; }
	public function getDateEdit() { return $this->dateEdit;}
}