<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Jean Forteroche">
    <link rel="icon" href="">

    <title><?= $pageTitle; ?></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
	  <link rel="stylesheet" href="../public/css/font-awesome/css/font-awesome.min.css">
	  <link rel="stylesheet" href="../public/css/style.css">
  </head>

  <body>
    <?php 
      include('../inc/navbar.php');

      echo $content;
      
      include('../inc/footer.php'); 
    ?>
    
    <!-- My JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../public/js/bootstrap.min.js"></script>

    <?php if(isset($_GET['p']) AND $_GET['p'] === 'admin' AND isset($_GET['menu']) AND $_GET['menu'] == 'write' OR isset($_GET['menu']) AND $_GET['menu'] == 'settings')
    {
      // TinyMCE
      ?>
      <script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=fzxs7q2usg4lvi36shaqwszm97smnt7e6nn7m0lj54uyzyhq"></script>
      <script>tinymce.init({
              selector: 'textarea',
              height: 100,
              menubar: false,
              plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media save table contextmenu paste code'
              ],
              toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
              content_css: '//www.tinymce.com/css/codepen.min.css'
            });</script>
      <?php
    }
    ?>
    <script src="../public/js/script.js"></script>
  </body>
</html>
