<?php
require '../app/Autoloader.php';
$manager = new ArticleManager('blog_ecrivain');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../../favicon.ico">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="../public/style.css">
		<title>Accueil</title>
	</head>
	<body>
		<div class="container container-index">
			<div class="pic-top"></div>
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
							
							<hr>
						</div>
						<?php
					}
				}
				?>

			<a href="../pages/admin.php">Vers la page d'administration</a>
		</div>
	</body>
</html>