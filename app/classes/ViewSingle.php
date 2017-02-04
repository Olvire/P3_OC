<?php
/**
 * Class for view single.
 */
class ViewSingle
{
	private $articleUnique;

	/**
	 * Constructor that takes as parameter an article (only one)
	 *
	 * @param array $articleUnique  The article unique
	 */
	public function __construct($articleUnique)
	{
		$this->articleUnique = $articleUnique;
	}

	/**
	 * Display the view of the single page
	 */
	public function display()
	{
		foreach($this->articleUnique as $article)
		{
			echo '<div class="single-article">';
			echo '<h3><em>#' . $article->get_id() . '</em>' . htmlspecialchars($article->get_title()) . '<br><small>Written by '. htmlspecialchars($article->get_author()) .'</small></h3>';
			echo '<p class="article-content">'. htmlspecialchars($article->get_content()) .'</p>';
			// echo '<div class="comments">'. $article->get_comments() .'</div>';
			echo '</div><br>';
			echo '<p><a href=".">Go to index</a></p>';
		}
	}
}