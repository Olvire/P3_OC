<?php

class AdminController
{
	public function execute()
	{
		$articleManager = new ArticleManager('blog_ecrivain');
		$listeArticles = $articleManager->get_articles();

		$viewAdmin = new ViewAdmin($listeArticles); // Avoid the repetition? (AdminController & HomeController)
		$viewAdmin->display();
	}
}