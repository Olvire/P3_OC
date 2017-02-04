<?php
// Le contrôleur récupère la liste des articles puis les transmet à la vue pour affichage

class IndexController 
{
	public function execute()
	{
		$articleManager = new ArticleManager('blog_ecrivain');
		$listeArticles = $articleManager->get_articles();

		$viewIndex = new ViewIndex($listeArticles);
		$viewIndex->display();
	}
}