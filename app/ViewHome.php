<?php
/**
 * Class for view home.
 */
class ViewHome
{
	private $listeArticles;

	/**
	 * Constructor that add the list of articles in param to the private attribute
	 *
	 * @param array $listeArticles  The liste of articles
	 */
	public function __construct($listeArticles)
	{
		$this->listeArticles = $listeArticles;
	}

	/**
	 * Display the view of the index page
	 */
	public function display()
	{
		echo '<div class="home-pic-top"></div>';
		if(empty($this->listeArticles))
		{
			echo 'There\'s no article to display (yet).';
		}
		else
		{
			foreach($this->listeArticles as $article)
			{
				echo '<div class="article">';
				echo $article->get_article_header();
				echo $article->get_extract();
				echo '<hr class="home-hr">';
				echo '</div>';
			}
		}
	}
}