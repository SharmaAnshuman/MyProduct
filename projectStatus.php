<?php
session_start();
  include 'config.php';
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
      
      <div class="container container-fluid">
            <form class="form-group" method="post">
                <input type="text" class="form-control" placeholder="Your Email Address" name="projectEmail" required>
                <input type="text" class="form-control" placeholder="Project Code(Check Your Email For The Code)" name="projectCode" required>
                <input type="submit" name="btn_proCheck" value="Check Project Progress" class="form-control btn btn-success"> 
            </form>
      </div>
      
      <div class="container">
          <div class="col-md-3">
              Project On Development<span class="badge">0+</span>
          </div>
          <div class="col-md-3">
              Project Completed <span class="badge">13+</span>
          </div>
          <div class="col-md-3">
              Number of User's<span class="badge">29+</span>
          </div>
      </div>
      
  </body>
</html>
<?php
if(isset($_REQUEST["btn_proCheck"]))
{
    $email = mysql_escape_string($_REQUEST["projectEmail"]);
    $id = mysql_escape_string($_REQUEST["projectCode"]);
    $row = mysql_query("select * from `projectdev` where `email`='$email' and `code`='$id' and `active`=1");
    if(mysql_num_rows($row)==1)
    {
        $_SESSION["PROCODE"]=$id;
        echo "<script>window.location='projectProgress.php'</script>";
    }
    else
    {
        echo "<script>alert('Project Not Found Check Details..');</script>";
    }
}
?>