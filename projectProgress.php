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
          
          <?php 
      $row = mysql_query("select * from `projectdev` where `code`='$_SESSION[PROCODE]'");
      $data = mysql_fetch_array($row);
     
      ?>
          
              <?php echo "Welcome ".$data['fullname']; ?>   
              <hr>
              <table class="table tab-content">
                  <th>Project Title</th><th>Project Type</th><th>Front-End</th><th>Back-End</th><th>Date</th>
                  <tr>
                      <td><?php echo $data['protitle']; ?></td>
                      <td><?php echo $data['typeofproject']; ?></td>
                      <td><?php echo $data['forntend']; ?></td>
                      <td><?php echo $data['backend']; ?></td>
                      <td><?php $date = date_create($data['dt']); echo date_format($date, 'd-M H:i a'); ?></td>
                  </tr>
              </table>
     <br/>
     <center>Status <h2>(<?php echo $data['status']; ?>)</h2></center>
     
          
          
              <div>
                  <?php 
                    if($data['download']!="" && $data['download']!=" " && $data['download']!=null)
                    {
                      ?><a href="projectProgress.php?download=<?php echo $data['download']; ?>">Download Now</a><?php
                    }
                    else
                    {
                          echo "<a>Download Link Not Available</a>";
                        
                        
                    }
                  ?>
              </div>
              
              <a href="projectsendmessage.php">Any Query's Send Message</a>
          
      </div>
      
    
      
  </body>
</html>

<?php

if(isset($_REQUEST["download"]))
{
    echo "<script>window.location='download/$data[download]' </script>";
}

?>