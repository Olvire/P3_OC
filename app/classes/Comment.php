<?php

class Comment
{
	private $id;
	private $title;
	private $content;
	private $date_post;
	private $author;

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

	
}