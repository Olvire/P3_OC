

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Jean Forteroche">
    <link rel="icon" href="">
    <?php if(isset($_GET['p']) AND $_GET['p'] === 'admin')
    {
      ?> 
      <script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=fzxs7q2usg4lvi36shaqwszm97smnt7e6nn7m0lj54uyzyhq"></script>
      <script>tinymce.init({
              selector: 'textarea',
              height: 200,
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

    <title><?= $page_title; ?></title>
	  <link rel="stylesheet" href="../public/css/font-awesome/css/font-awesome.min.css">
	  <link rel="stylesheet" href="../public/css/style.css">
    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
    <?php 
      include('../app/navbar.php');

      echo $content;
      
      include('../app/footer.php'); 
    ?>

    <script src="../public/js/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../public/js/script.js"></script>
  </body>
</html>
