<?php
// Le contrôleur récupère la liste des articles puis les transmet à la vue pour affichage

/**
 * Controls the data flow into a home object and updates the view whenever data changes.
 */
class HomeController 
{
	public function execute()
	{
		$articleManager = new ArticleManager('blog_ecrivain');
		$listeArticles = $articleManager->get_articles();

		$viewHome = new ViewHome($listeArticles); // Avoid the repetition? (AdminController & HomeController)
		$viewHome->display();
	}
}