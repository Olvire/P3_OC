<?php
session_start();

/**
 * Autoloader permettant de charger les différentes classes de l'app.
 * @param string $classname Le nom de la classe à charger
 */
function autoload($classname) {
	if(file_exists($file = '../controleurs/' . $classname . '.php')) {
		require $file;
	} elseif(file_exists($file = '../modeles/' . $classname . '.php')) {
		require $file;
	} elseif(file_exists($file = '../vues/' . $classname . '.php')) {
		require $file;
	}
}

spl_autoload_register('autoload');

$pageTitle = 'Jean Forteroche';

// Routes
if(isset($_GET['p'])) {
	$p = $_GET['p'];
} else {
	$p = 'home';
}

// Enclenche la temporation de sortie. Nécessaire pour le système de template mis en place pour l'app.
ob_start();

// Personnalisation du titre de page et appel des différents contrôleurs en fonction de la route.
if($p === 'home') {
	$pageTitle .= ' - Bienvenue';
	$controller = new HomeController();
    $controller->execute();
} elseif($p === 'single') {
	$controller = new SingleController();
    $controller->execute();
} elseif($p === 'admin') {
	if(!isset($_SESSION['username']) OR isset($_SESSION['username']) AND $_SESSION['username'] !== 'Jean') {
		header('Location: index.php?p=login');
	} else {
		$pageTitle .= ' - Tableau de bord';
		$controller = new AdminController();
		$controller->execute();
	}
} elseif($p === 'login') {
	if(isset($_SESSION['username']) AND $_SESSION['username'] == 'Jean') {
		header('Location: index.php');
	} else {
		$pageTitle .= ' - Connexion';
		$controller = new LoginController();
		$controller->execute();
	}
} elseif($p === 'about') {
	$pageTitle .= ' - À propos';
	$controller = new AboutController();
	$controller->execute();
} elseif($p === 'mentions') {
	$pageTitle .= ' - Mentions légales';
	$controller = new MentionsController();
	$controller->execute();
} elseif($p === 'logout') {
	session_start();
	session_destroy();
	header('Location: index.php');
	exit();
} else {
	$controller = new ErrorController();
	$controller->execute();
}

$content = ob_get_clean();
require '../vues/template/default.php';