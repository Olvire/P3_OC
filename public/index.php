<?php
// Point d'entrée de l'application
require '../Controllers/AdminController.php';
require '../Controllers/HomeController.php';
require '../Controllers/SingleController.php';
require '../app/classes/Article.php';
require '../app/classes/Comment.php';
require '../Models/ArticleManager.php';
require '../Models/CommentManager.php';
require '../app/classes/adminForm.php';
require '../app/ViewHome.php';
require '../app/ViewSingle.php';
require '../app/ViewAdmin.php';

$manager = new ArticleManager('blog_ecrivain'); // // Avoid the repetition? (with AdminController & HomeController)

// Publish an article
if(!isset($_POST['title']) OR empty($_POST['title']) AND !isset($_POST['author']) OR empty($_POST['author']) AND !isset($_POST['content']) OR empty($_POST['content'])) {
	// Do nothing
} else {
	$manager->add($_POST['title'], $_POST['author'], $_POST['content']);
}

// Edit & delete features
if(isset($_GET['p']) AND $_GET['p'] === 'admin' AND isset($_GET['delete']) AND isset($_GET['id'])) {
	$manager->delete_article();
	header('Location: .?p=admin');
}

// Delete all articles
if(isset($_GET['p']) AND $_GET['p'] === 'admin' AND isset($_GET['truncate'])) {
	$manager->delete_all();
	header('Location: .?p=admin');
}


$page_title = 'Mon blog d\'écrivain';

// Routes //
if(isset($_GET['p'])) {
	$p = $_GET['p'];
} else {
	$p = 'home';
}

ob_start();
if($p === 'home') {
	require '../pages/home.php';
} elseif($p === 'single') {
	require '../pages/single.php';
} elseif($p === 'admin') {
	require '../pages/admin.php';
}


$content = ob_get_clean();
require '../pages/template/default.php';