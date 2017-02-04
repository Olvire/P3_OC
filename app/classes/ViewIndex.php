<?php
/**
 * Class for view index.
 */
class ViewIndex
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
		if($this->listeArticles == 0)
		{
			echo 'There\'s no article to display.';
		}
		else
		{
			foreach($this->listeArticles as $article)
			{
				echo '<div class="article">';
				echo '<h3><a href=?p=single&id='. $article->get_id() .'><em>#' . $article->get_id() . '</em> - ' . htmlspecialchars($article->get_title()) . '</a></h3>';
				echo '<p><small>Written by ' . htmlspecialchars($article->get_author()) . ' - ' . $article->get_date_post()->format('d/m/Y at H:hi') . '</small></p>';
				echo '<p>' . htmlspecialchars(substr($article->get_content(), 0, 500)) . '...</p>';
				echo '<p><a href="?p=single&id='. $article->get_id() . '">Lire la suite</a></p>';
				echo '<hr>';
				echo '</div>';
			}
		}
	}
}