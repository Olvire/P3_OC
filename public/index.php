<?php
session_start();

// Point d'entrée de l'application
require '../controleurs/Controller.php';
require '../controleurs/AdminController.php';
require '../controleurs/HomeController.php';
require '../controleurs/SingleController.php';
require '../controleurs/ErrorController.php';
require '../controleurs/AboutController.php';
require '../modeles/Article.php';
require '../modeles/ArticleManager.php';
require '../modeles/Comment.php';
require '../modeles/CommentManager.php';
require '../vues/AdminForm.php';
require '../vues/LoginForm.php';
require '../vues/Home.php';
require '../vues/Single.php';
require '../vues/Admin.php';
require '../vues/Erreur.php';
require '../vues/About.php';

$page_title = 'Jean Forteroche';

// Routes
if(isset($_GET['p'])) {
	$p = $_GET['p'];
} else {
	$p = 'home';
}

ob_start();
if($p === 'home') {
	$page_title .= ' - Bienvenue';
	$controller = new HomeController();
    $controller->execute();
} elseif($p === 'single') {
	$controller = new SingleController();
    $controller->execute();
} elseif($p === 'admin') {
	$page_title .= ' - Tableau de bord';
	$controller = new AdminController();
	$controller->execute();
} elseif($p === 'about') {
	$page_title .= ' - À propos';
	$controller = new AboutController();
	$controller->execute();
} else {
	$controller = new ErrorController();
	$controller->execute();
}

$content = ob_get_clean();
require '../vues/template/default.php';