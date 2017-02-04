<?php
/**
 * Class that model an article for the app.
 */
class Article
{	
	private $id;
	private $title;
	private $content;
	private $author;
	private $date_post;

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

	/**
	 * Sets the identifier.
	 *
	 * @param integer $id The identifier
	 */
	public function set_id($id)
	{
		if(is_int($id) AND $id > 0)
		{
			$this->id = $id;
		}
	}

	/**
	 * Sets the title.
	 *
	 * @param string $title The title
	 */
	public function set_title($title)
	{
		if(is_string($title))
		{
			$this->title = $title;
		}
	}

	/**
	 * Sets the content.
	 *
	 * @param string $content The content
	 */
	public function set_content($content)
	{
		if(is_string($content))
		{
			$this->content = $content;
		}
	}

	/**
	 * Sets the author.
	 *
	 * @param string $author The author
	 */
	public function set_author($author)
	{
		if(is_string($author))
		{
			$this->author = $author;
		}	
	}

	public function set_date_post(DateTime $date_post)
	{
		$this->date_post = $date_post;
	}

	/**
	 * Gets the identifier.
	 *
	 * @return int The identifier.
	 */
	public function get_id()
	{
		return $this->id;
	}

	/**
	 * Gets the title.
	 *
	 * @return string The title.
	 */
	public function get_title()
	{
		return $this->title;
	}

	/**
	 * Gets the content.
	 *
	 * @return string The content.
	 */
	public function get_content()
	{
		return $this->content;
	}

	/**
	 * Gets the author.
	 *
	 * @return string The author.
	 */
	public function get_author()
	{
		return $this->author;
	}

	/**
	 * Gets the date post.
	 *
	 * @return The date post.
	 */
	public function get_date_post()
	{
		return $this->date_post;
	}
}