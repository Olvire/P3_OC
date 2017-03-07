<?php

class Comment
{
	private $id;
	private $articleId;
	private $parentId = 0;
	private $title;
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

	public function addSubComment($subComment) {
		$this->subComments[] = $subComment;
	}

	// SETTERS //
	public function setId($id) {
		if(is_int($id) AND $id > 0) {
			$this->id = $id;
		}
	}

	public function setArticleId($articleId) {
		$this->articleId = (int) $articleId;
	}

	public function setParentId($parentId) {
		if($parentId >= 0) {
			$this->parentId = $parentId;
		}
	}

	public function setTitle($title) {
		if(is_string($title) AND !empty($title)) {
			$this->title = $title;
		}
	}

	public function setContent($content) {
		if(is_string($content) AND !empty($content)) {
			$this->content = $content;
		}
	}

	public function setDatePost(DateTime $datePost) {
		$this->datePost = $datePost;
	}

	public function setAuthor($author) {
		if(is_string($author) AND !empty($author)) {
			$this->author = $author;
		}
	}

	public function setSignaler($signaler) {
		if(is_int($signaler) AND !empty($signaler)) {
			$this->signaler = $signaler;
		}
	}

	public function setSubComments($subComments) {
		$this->subComments = $subComments;
	}
	
	// GETTERS //
	public function getId() { return $this->id; }
	public function getArticleId() { return $this->articleId; }
	public function getParentId() { return $this->parentId; }
	public function getTitle() { return $this->title; }
	public function getContent() { return $this->content; }
	public function getDatePost() { return $this->datePost; }
	public function getAuthor() { return $this->author; }
	public function getSignaler() { return $this->signaler; }
	public function getSubComments() { return $this->subComments; }
}