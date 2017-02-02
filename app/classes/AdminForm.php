<?php
class AdminForm
{
	private $surround = 'form-group';

	public function surround($html)
	{
		return "<div class=\"{$this->surround}\">{$html}</div>";
	}

	/**
	 * @return string A title input for the article
	 */
	public function title_field()
	{
		return $this->surround('<label for="title">Title: </label><input type="text" name="title" class="form-control">');
	}

	public function author_field()
	{
		return $this->surround('<label for="author">Author: </label><input type="text" name="author" class="form-control">');
	}

	/**
	 * @return string A content textarea for the article
	 */
	public function content_field()
	{
		return $this->surround('<label for="content">Content: </label><textarea name="content" class="form-control"></textarea>');
	}

	/**
	 * @return string The submit button
	 */
	public function submit()
	{
		return '<button type="submit" class="btn btn-primary">Send</button>';
	}

}