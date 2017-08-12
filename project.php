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
          
          <form class="form-group" method="POST">
              <input type="text" class="form-control" placeholder="Your Full Name" name="fullname" required>
              <input type="text" class="form-control" placeholder="Project Title" name="protitle" required>
              <input type="email" class="form-control" placeholder="Your Email Address" name="email" required>
              <input type="text" class="form-control" placeholder="What Course Are You Studying..?" name="course" required>
              <select class="form-control" name="typeofproject">
                  <option>Web Site</option>
                  <option>Desktop</option>
                  <option>Android</option>
                  <option>Other</option>
              </select>
              <select class="form-control" name="forntend">
                  <option value="Asp .Net">Asp .Net</option>
                  <option value="C# .Net">C# .Net</option>
                  <option value="PHP">PHP</option>
                  <option value="JSP">JSP</option>
                  <option value="JAVA">JAVA</option>
                  <option value="Other">Other</option>
              </select>
              <select class="form-control" name="backend">
                  <option value="MSSQl">MSSQL</option>
                  <option value="MySql">MySql</option>
                  <option value="Oracle">Oracle</option>
                  <option value="Access">Access</option>
                  <option value="Other">Other</option>
              </select>
              <textarea class="form-control" name="other" placeholder="Your Project Requriments."></textarea>
              <input type="submit" name="btn_pro" value="Request For Project" class="form-control btn btn-success"> 
          </form>
          
      </div>
      
      <div class="container">
          <div class="col-md-3">
              <a href="projectStatus.php" class="btn btn-warning">Check Your Project Progress</a>
          </div>
          <div class="col-md-3">
              <a class="btn btn-primary" > Project On Development <span class="badge">0+</span></a>
          </div>
          <div class="col-md-3">
              <a class="btn btn-primary" >Project Completed <span class="badge">13+</span></a>
          </div>
          <div class="col-md-3">
              <a class="btn btn-primary" > Number of User's <span class="badge">29+</span></a>
          </div>
      </div>
      
  </body>
</html>
<?php
if(isset($_REQUEST["btn_pro"]))
{
    $fullnm =mysql_escape_string($_REQUEST["fullname"]);
    $protitle =mysql_escape_string($_REQUEST["protitle"]);
    $email =mysql_escape_string($_REQUEST["email"]);
    $course =mysql_escape_string($_REQUEST["course"]);
    $typeofproject =mysql_escape_string($_REQUEST["typeofproject"]);
    $forntend =mysql_escape_string($_REQUEST["forntend"]);
    $backend =mysql_escape_string($_REQUEST["backend"]);
    $other =mysql_escape_string($_REQUEST["other"]);
    $dt = date("Y-m-d H:i:s");
    $code = rand(1111, 9999);
    if(mysql_query("INSERT INTO `projectdev`(`code`,`fullname`, `protitle`, `email`, `course`, `typeofproject`, `forntend`, `backend`, `other`, `active`,`dt`) VALUES ('$code','$fullnm','$protitle','$email','$course','$typeofproject','$forntend','$backend','$other','1','$dt')"))
    {
       $rowID= mysql_query("select * from `projectdev` where `fullname`='$fullnm' and `protitle`='$protitle' and `email`='$email' and `other`='$other'");
       $LastId=mysql_fetch_array($rowID);
             $to = "$email";
             $subject = "AshuSharma.com Project Request Accepted" ;
             $body = ""
                     . "<h3>Project Request No. [$code]  <br/>"
                     . "Please Register With Us.. <br/>"
                     . "you can check your project progress on <br/>"
                     . "http://ashusharma.com/projectStatus.php<br/><br/><br/><br/> </h3>"
                     . "<a href='http://ashusharma.com'>Unsubscribe</a>";
                $headers = 'From:Admin@AshuSharma.com' . "\r\n" ;
                $headers .='X-Mailer: PHP/' . phpversion();
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";   
                mail($to, $subject, $body,$headers);
               
        echo "<script>alert('Thank You.. We Will Send Mail As Soon As Possible(Check Inbox/Spam)')</script>";
        echo "<script>window.location='index.php'</script>";
    }
    else
    {
        echo "<script>alert('Please Try Agine..')</script>";
    }
}
?>