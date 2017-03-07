<footer>
  <div class="container">
    <div class="row">
      <div class="col-sm-4 text-center">
        <p class="text-justify">J'ai décidé de partager avec vous, qui me suivez et appréciez mes histoires, mon nouveau roman, chapitre après chapitre.</p>
      </div>

      <div class="col-sm-4 text-center">
        <p>Test</p>
      </div>
      
      <div class="col-sm-4 links text-center">
      <?php
      if(isset($_GET['p']) AND $_GET['p'] == 'admin') {
        echo '<a class="btn btn-default" href=".?p=home">Accueil</a>';
      } else {
        echo '<a class="btn btn-default" href=".?p=admin">Administration</a>';
      }
      ?>
      </div>

    </div>
  </div>
</footer>