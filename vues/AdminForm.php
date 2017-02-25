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
		return $this->surround('<label for="title">Titre </label><input type="text" name="title" class="form-control" value="' . isset($_GET['action']) AND $_GET['action'] == 'edit' ? 
				$articleManager->get_title() : null . '">');
	}

	public function author_field()
	{
		return $this->surround('<label for="author">Auteur </label><input type="text" name="author" class="form-control" value="' . isset($_GET['action']) AND $_GET['action'] == 'edit' ? 
				$articleManager->get_author() : null . '">');
	}

	/**
	 * @return string A content textarea for the article
	 */
	public function content_field()
	{
		return $this->surround('<label for="content">Contenu </label><textarea name="content" class="form-control">' .isset($_GET['action']) AND $_GET['action'] == 'edit' ? 
				$articleManager->get_content() : null . '</textarea>');
	}

	/**
	 * @return string The submit button
	 */
	public function submit()
	{
		return '<button type="submit" class="btn btn-primary">Publier</button>';
	}

}