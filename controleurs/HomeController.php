<?php

class HomeController extends Controller
{
	public function execute()
	{
		// Nombre d'articles que l'on veut par page.
		$articles_par_page = 3;

		// On compte le nombre total d'articles présents dans la bdd.
		$nombre_articles = $this->articleManager->count();

		// Nombre de pages.
		$nombre_de_pages = ceil($nombre_articles / $articles_par_page);

		if(isset($_GET['page']))
		{
			$page_actuelle = intval($_GET['page']);

			if($page_actuelle > $nombre_de_pages)
			{
				$page_actuelle = $nombre_de_pages;
			}
		}
		else
		{
			$page_actuelle = 1;
		}

		$premier_article = ($page_actuelle - 1) * $articles_par_page;

		$liste_articles = $this->articleManager->get_list($premier_article, $articles_par_page);

		$viewHome = new ViewHome($liste_articles, $nombre_de_pages, $page_actuelle);
		$viewHome->display();
	}
}