<?php

class ViewAdmin
{
	private $listeArticles;

	public function __construct($listeArticles)
	{
		$this->listeArticles = $listeArticles;
	}

	public function display()
	{
		// Welcome Message
		echo '<h2>Welcome to your administration page!</h2>';
		echo '<p>On this page, you can write new articles, modify or delete the previous ones and manage the comments that have been left on your articles.</p><br>';
		echo '<div class="admin-pic-top"></div>';

		// New Article
		echo '<h3 id="admin-1">Write an article</h3>';
		echo '<div class="admin-new-article">';
		$adminForm = new adminForm(); // Not sure about it
		echo '<form action=".?p=admin" method="post">';
		echo $adminForm->title_field();
		echo $adminForm->author_field();
		echo $adminForm->content_field();
		echo $adminForm->submit();
		echo '</form>';
		echo '<hr>';
		echo '</div>';

		// List of articles
		echo '<h3 id="admin-2">List of articles</h3>';
		if(empty($this->listeArticles))
		{
			echo 'You didn\'t write articles yet.';
			echo '<hr>';
		}
		else
		{	
			echo '<div class="admin-articles">';
			foreach($this->listeArticles as $article)
			{
				echo $article->get_article_header();
				echo $article->get_extract();
				echo '<a href="" class="btn btn-warning edit">Edit</a>';
				echo '<a href="?p=admin&delete&id='.$article->get_id().'" class="btn btn-danger delete">Delete</a>';
				echo '<hr>';
			}
			echo '</div>';
		}

		// Danger zone
		echo '<h3 id="admin-3">Danger Zone</h3>';
		echo '<div class="admin-danger-zone">';
		echo '<a href="?p=admin&truncate" class="btn btn-danger">Delete all articles</a>';
		echo '</div>';
	}
}