<?php
class Article
{
	private $erreurs = [];
	private $id;
	private $title;
	private $content;
	private $author;
	private $date_post;
	private $date_edit;
	private $nb;

	const AUTEUR_INVALIDE = 1;
	const TITRE_INVALIDE = 2;
	const CONTENU_INVALIDE = 3;

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
		if(!is_string($title) OR empty($title)) 
		{
			$this->erreurs[] = self::TITRE_INVALIDE;
		}
		else
		{
			$this->title = $title;
		}
	}

	public function set_content($content)
	{
		if(!is_string($content) OR empty($content)) 
		{
			$this->erreurs[] = self::CONTENU_INVALIDE;
		}
		else
		{
			$this->content = $content;
		}
	}

	public function set_author($author)
	{
		if(!is_string($author) OR empty($author)) 
		{
			$this->erreurs[] = self::TITRE_INVALIDE;
		} 
		else 
		{
			$this->author = $author;
		}
	}

	public function set_date_post(DateTime $date_post)
	{
		$this->date_post = $date_post;
	}

	public function set_date_edit(DateTime $date_edit)
	{
		$this->date_edit = $date_edit;
	}

	public function set_nb($nb)
	{
		$this->nb = $nb;
	}

	// GETTERS //
	public function get_erreurs()
	{
		return $this->erreurs;
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

	public function get_author()
	{
		return $this->author;
	}

	public function get_date_post()
	{
		return $this->date_post;
	}

	public function get_date_edit()
	{
		return $this->date_edit;
	}

	public function get_nb()
	{
		return $this->nb;
	}
}