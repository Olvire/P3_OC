<h2>Connexion à l'espace d'administration</h2>

<hr>

<?php

$loginForm = new LoginForm();

echo '<form action="index.php?p=admin" method="post">';
echo $loginForm->usernameField();
echo $loginForm->passwordField();
echo $loginForm->submit();
echo '</form><br>';
echo '<a href="index.php"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Retour à la page d\'accueil</a>';