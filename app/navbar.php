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
      <ul class="nav navbar-right navbar-nav">
        <li <?php if(!isset($_GET['p']) OR (isset($_GET['p']) AND $_GET['p'] == 'home')) echo 'class="active"'; ?>>
          <a href="index.php">Home</a>
        </li>
        <li <?php if(isset($_GET['p']) AND $_GET['p'] == 'about') echo 'class="active"'; ?>><a href="index.php?p=about">About</a></li>
        <li <?php if(isset($_GET['p']) AND $_GET['p'] == 'contact') echo 'class="active"'; ?>><a href="index.php?p=contact">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>