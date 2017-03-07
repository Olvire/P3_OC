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
	public function titleField()
	{
		return $this->surround('<label for="title">Titre </label><input type="text" name="title" class="form-control" value="' . isset($_GET['action']) AND $_GET['action'] == 'edit' ? 
				$articleManager->getTitle() : null . '">');
	}

	public function authorField()
	{
		return $this->surround('<label for="author">Auteur </label><input type="text" name="author" class="form-control" value="' . isset($_GET['action']) AND $_GET['action'] == 'edit' ? 
				$articleManager->getAuthor() : null . '">');
	}

	/**
	 * @return string A content textarea for the article
	 */
	public function contentField()
	{
		return $this->surround('<label for="content">Contenu </label><textarea name="content" class="form-control">' .isset($_GET['action']) AND $_GET['action'] == 'edit' ? 
				$articleManager->getContent() : null . '</textarea>');
	}

	/**
	 * @return string The submit button
	 */
	public function submit()
	{
		return '<button type="submit" class="btn btn-primary">Publier</button>';
	}

}