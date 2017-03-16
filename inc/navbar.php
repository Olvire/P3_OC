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
        <li><a href="index.php?p=login">Connexion</a></li>
        <?php } else { ?>
        <li><a href="../inc/logout.php">Déconnexion</a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>