<?php

class Comment
{
	private $id;
	private $title;
	private $content;
	private $date_post;
	private $author;
	private $article_id;

	/**
	 * @param array $value The value taken by the constructor to fill the variables
	 */
	public function __construct($value = [])
	{
		if(!empty($value))
		{
			$this->hydrate($value);
		}
	}

	/**
	 * @param array $data The data that will help the constructor
	 */
	public function hydrate($data)
	{
		foreach($data as $key => $value)
		{
			$method = 'set_';
			if(method_exists([$this, $method]))
			{
				$this->$method($value);
			}
		}
	}

	public function set_id($id)
	{
		if(is_int($id) AND $id > 0)
		{
			$this->id = $id;
		}
	}

	public function set_title($title)
	{
		if(is_string($title) AND !empty($title))
		{
			$this->title = $title;
		}
	}

	public function set_content($content)
	{
		if(is_string($content) AND !empty($content))
		{
			$this->content = $content;
		}
	}

	public function set_date_post(DateTime $date_post)
	{
		$this->date_post = $date_post;
	}

	public function set_author($author)
	{
		if(is_string($author) AND !empty($author))
		{
			$this->author = $author;
		}
	}

	public function set_article_id($article_id)
	{
		if(is_int($article_id) AND $article_id > 0)
		{
			$this->article_id = $article_id;
		}
	}
	
	public function get_id()
	{
		return $this->id;
	}

	public function get_title()
	{
		return $this->title;
	}

	public function get_content()
	{
		return $this->content;
	}

	public function get_date_post()
	{
		return $this->date_post;
	}

	public function get_author()
	{
		return $this->author;
	}

	public function get_article_id()
	{
		return $this->article_id;
	}
}