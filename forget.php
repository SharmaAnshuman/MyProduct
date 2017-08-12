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
          
          <form class="form-group">
              <input type="number" class="form-control" placeholder="Mobile Number" name="mobile"> 
              <input type="email" class="form-control" placeholder="Email Address" name="email">
              <input type="submit" name="btn_forget" value="Forget Password" class="form-control btn btn-success"> 
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
if(isset($_REQUEST["btn_forget"]))
{
    $mob  = mysql_escape_string($_REQUEST["mobile"]);
    $email = mysql_escape_string($_REQUEST["email"]);
    $r = mysql_query("select * from `members` where email='$email' and mobile='$mob'");
    
    $cou = mysql_num_rows($r);
    $arr=  mysql_fetch_array($r);
    if($cou==0)
    {
        echo "<script>alert('User not found please check your details')</script>";
    }
    else
    {
             $to = "$email";
             $subject = "AshuSharma.com Your Password Is [$arr[password]]" ;
             $body = ""
                     . "You can login with your mobile and email address <br/>"
                     . "your password is [$arr[password]]<br/><br/> if you wanted to project request on http://ashu.mohansharma.com/project.php<br/> "
                     . "<a href='http://ashu.mohansharma.me'>Unsubscribe</a>"
                     ."<a href='http://ashu.mohansharma.me/ProjectDev.apk'><img src='http://ashu.mohansharma.me/graphics/AndyNew.png'/></a>";

                $headers = 'From:Admin@AshuSharma.com' . "\r\n" ;
                $headers .='Reply-To: '. $to . "\r\n" ;
                $headers .='X-Mailer: PHP/' . phpversion();
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";   
                if(mail($to, $subject, $body,$headers)) 
                {
                    echo "<script>alert('Check Your EMail(spam) Password has been Send')</script>";            
                } 
                else 
                {
                        echo "<script>alert('Sorry Mail Not Send Please try agine..!')</script>";            //not send
                }
                echo "<script>window.location='index.php'</script>";
    }
}
?>