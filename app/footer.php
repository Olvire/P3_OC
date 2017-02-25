<footer>
  <div class="container">
    <p><?php echo 'Jérôme Butel &copy; ' . date('Y'); ?></p>
    <p class="nothing"></p>
    <div class="links">
    <?php
    if(isset($_GET['p']) AND $_GET['p'] == 'admin') {
      echo '<a class="btn btn-default" href=".?p=home">Accueil</a>';
    } else {
      echo '<a class="btn btn-default" href=".?p=admin">Administration</a>';
    }
    ?>
    </div>
  </div>
</footer>