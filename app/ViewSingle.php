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
		if(empty($this->articleUnique)) {
			echo 'Hey, there\'s nothing here';
		} else {
			echo '<div class="single-article">';
			echo $this->articleUnique->get_article_header();
			echo '<p class="article-content">'. $this->articleUnique->get_content() .'</p>';
			echo '<div class="comments-container">';
			echo '<strong>Commentaires </strong>(0)</div>'; // TODO
			echo '<div class="comments">';
			echo '<a class="leave-comment-link" "href="#">Leave a comment</a>'; // TODO
			echo '<hr>';
			echo '</div>';
			echo '</div><br>';
			echo '<p><a href=".">Go to index</a></p>';
		}
	}
}