<?php
session_start();
  include 'config.php';
  if(isset($_SESSION['PROCODE']))
  {
      
  }
  else
  {
      header("Location: projectStatus.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ashu Sharma</title>
    <link rel="icon" type="image/gif" href="graphics/ashu.ico" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    </script>
  </head>
  <body>
      <?php include './view/title.php';?>
      <div>
          
      Under Development
      </div>
      
   
  </body>
</html>
<?php
if(isset($_REQUEST["btn_pro"]))
{
   
}
?>