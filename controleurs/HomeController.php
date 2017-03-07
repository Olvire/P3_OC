<?php

class HomeController extends Controller {
	public function execute() {
		// Nombre d'articles que l'on veut par page.
		$articlesPerPage = 4;

		// On compte le nombre total d'articles présents dans la bdd.
		$numberOfArticles = $this->articleManager->count();

		// Nombre de pages.
		$numberOfPages = ceil($numberOfArticles / $articlesPerPage);

		if(isset($_GET['page']) AND empty($_GET['page'])) {
			$currentPage = 1;
		} elseif(isset($_GET['page']) AND !empty($_GET['page'])) {
			$currentPage = intval($_GET['page']);

			if($currentPage > $numberOfPages) {
				$currentPage = $numberOfPages;
			}
		} else {
			$currentPage = 1;
		}

		$firstArticle = ($currentPage - 1) * $articlesPerPage;
		$listOfArticles = $this->articleManager->getList($firstArticle, $articlesPerPage);

		$viewHome = new ViewHome($listOfArticles, $numberOfPages, $currentPage);
		$viewHome->display();
	}
}