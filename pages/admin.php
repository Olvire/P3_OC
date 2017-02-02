<?php
require '../app/Autoloader.php';
$adminForm = new AdminForm();
$manager = new ArticleManager('blog_ecrivain');
if(isset($_POST['title']) AND !empty($_POST['title']) AND isset($_POST['content']) AND !empty($_POST['content']) AND isset($_POST['author']) AND !empty($_POST['author']))
{
	$manager->add($_POST['title'], $_POST['content'], $_POST['author']);
	header('Location: admin.php');
}

if(isset($_GET['delete']))
{
	$manager->delete_article();
	header('Location: admin.php');
}

if(isset($_POST['truncate']))
{
	$manager->delete_all();
	header('Location: admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../../favicon.ico">
	    <!-- Start Twitter Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="../public/style.css?<?php echo time(); ?>">
		<!-- TinyMCE -->
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  		<script>tinymce.init({ selector:'textarea', plugins : 'advlist autolink link image lists charmap print preview' });</script>
		<title>Administration</title>
	</head>

	<body>
		<!-- Fixed navbar -->
	    <nav class="navbar navbar-default">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="#">Mon blog d'écrivain</a>
	        </div>
	      </div>
	    </nav>

		<div class="container container-admin">
			<div class="page-header">
				<h1>Administration</h1>
				<p>Hello dear administrator,</p>
				<p>On this page, you'll be able to add, edit, or delete articles of the blog. You can see the number of articles already created and you have the possibility to delete every articles.</p>
				<p>If you want to ask questions about this administration page, the blog, or just want to contact us, please send a message to <a href="mailto:contact@admin.com">contact@admin.com</a>. Thank you!
			</div>

			<!-- Début du compteur d'articles -->
			<h2>Total number of articles</h2>
			<p>The current number of articles in the database is : <span class="text-primary"><strong><?= $manager->count(); ?></strong></span>
			<hr>

			<h2>Write an article</h2>
			<form action="admin.php" method="post">
				<?php
				echo $adminForm->title_field();
				echo $adminForm->author_field();
				echo $adminForm->content_field();
				echo $adminForm->submit();
				?>
			</form>

			<hr>

			<!-- Début de la liste d'articles -->
			<h2>List of articles</h2>
			<?
			$liste = $manager->get_articles();
			if($manager->count() == 0)
			{
				echo 'There\'s no article in the database.';
			} else {
				foreach($liste as $article)
				{
					?>
					<div class="article">
						<h3>
							<?= '<em>#' . $article->get_id() . '</em> ' . htmlspecialchars($article->get_title()); ?>
						</h3>
						
						<p><small>Written by <?= htmlspecialchars($article->get_author()); ?></small></p>
						
						<p><?= $article->get_content(); ?></p>

						<form action="." method="post">
							<a href="?edit&id='<?= $article->get_id(); ?>'" class="btn btn-warning btn-sm" disabled="disabled">Edit</a>
							<a href="?delete&id='<?= $article->get_id(); ?>'" class="btn btn-danger btn-sm">Supprimer</a>
						</form>
						
						<hr>
					</div>
					<?php
				}
			}
			?>
			<h2>Dangerous zone</h2>
			<p>The button herebelow will delete all the articles in the database.</p>
			<form action="#" method="post">
				<button type="submit" name="truncate" class="btn btn-danger btn-sm">DELETE ARTICLES</button>
			</form><br>
		</div>

		<footer>
			<div class="container">
				<a href="../public/index.php">Vers l'accueil</a>
				<span class="nothing"></span>
				<span class="copyright">&copy; Jérôme Butel | <?= date('Y'); ?></span>
			</div>
		</footer>
	</body>
</html>