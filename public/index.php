<?php
// Point d'entrée de l'application

require '../app/classes/Article.php';
require '../Models/ArticleManager.php';
require '../Controllers/AdminController.php';
require '../Controllers/IndexController.php';
require '../Controllers/SingleController.php';
require '../app/classes/ViewIndex.php';
require '../app/classes/ViewSingle.php';
require '../app/classes/ViewAdmin.php';

$page_title = 'Mon blog d\'écrivain';

if(isset($_GET['p'])) 
{
	$p = $_GET['p'];
} 
else 
{
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