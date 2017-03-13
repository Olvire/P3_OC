<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Blog de Jean Forteroche</a>
    </div>

    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li <?php if(!isset($_GET['p']) OR (isset($_GET['p']) AND $_GET['p'] == 'home')) echo 'class="active"'; ?>>
          <a href="index.php">Blog</a>
        </li>
        <li <?php if(isset($_GET['p']) AND $_GET['p'] == 'about') echo 'class="active"'; ?>><a href="index.php?p=about">À propos</a></li>

        <?php if(!isset($_SESSION['username'])) { ?>
        <li><a href="index.php?p=admin">Connexion</a></li>
        <?php } else { ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['username']; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?p=profile">Mon profil</a></li>
            <?php if($_SESSION['username'] == 'Jean') echo '<li><a href="index.php?p=admin">Administration</a></li>'; ?>
            <li role="separator" class="divider"></li>
            <li><a href="../inc/logout.php">Déconnexion</a></li>
          </ul>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>