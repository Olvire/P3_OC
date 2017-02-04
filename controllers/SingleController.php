<?php
/**
 * Controls the data flow into a single object and updates the view whenever data changes.
 */
class SingleController
{	
	/**
	 * Execute the article manager to get an unique article, then gives it to the view to display
	 */
	public function execute()
	{
		$articleManager = new ArticleManager('blog_ecrivain');
		$articleUnique = $articleManager->get_article();

		$viewSingle = new ViewSingle($articleUnique);
		$viewSingle->display();
	}
}