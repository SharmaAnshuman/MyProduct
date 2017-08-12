<?php
  session_start();
  if(isset($_SESSION["user"]))
  {
      header("Location: home.php");
  }
   if(isset($_SESSION["UID"]))
  {
      header("Location: home.php");
  }
  include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="alternate" hreflang="es" href="http://ashusharma.com/" />
    <title>Ashu Sharma</title>
    <link rel="icon" type="image/gif" href="graphics/ashu.ico" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        <?php

        if(isset($_REQUEST["btn_login"]))
        {
            ?>
            $(document).ready(function()
            {
                $("#RegisterError").hide();
                
            });
            <?php
        }
        else if(isset($_REQUEST["btn_register"]))
        {
             ?>
                $(document).ready(function()
                {
                    $("#LoginError").hide();
                });
            <?php
        }
        else
        {
            ?>
                $(document).ready(function()
                {
                    $("#LoginError").hide(); 
                    $("#RegisterError").hide();
                });
            <?php
        }
            
        ?>
        
      
       function Loginchk()
       {
           
           var user = $("#Login_emailmobile").val();
           var pwd = $("#Login_password").val();
           if(user.length!=0 && pwd.length!=0)
           {
               return true;
               
           }
           else
           {
                $("#LoginError").show(); 
                if(user.length==0)
                {
                    $("#LoginError").html("<center>Please Enter Email or Mobile</center>");
                }
                else if(pwd.length==0)
                {
                    $("#LoginError").html("<center>Please Enter Password</center>");
                }
                
           }
           
           return false;
       }
       
       
      
       function Registerchk()
       {
           var Name = $("#Name").val();
           var Username = $("#Username").val();
           var Password = $("#Password").val();
           var Email = $("#Email").val();
           var Mobile = $("#Mobile").val();
           if(Name.length!=0 && Username.length!=0 && Password.length!=0 &&  Email.length!=0 && Mobile.length!=0)
           {
               //Mobile.isNumeric
               //how to check js var is int or not
               
               
               if(parseInt(Mobile))
               {
                   if(Mobile.length==10)
                    return true;
                   else
                        $("#RegisterError").html("<center>Please Enter 10-digit MobileNumber</center>");
               }
               else
               {
                        $("#RegisterError").html("<center>Please Enter Vaild MobileNumber</center>");
               }
               
           }
           else
           {
                $("#RegisterError").show(); 
                if(Name.length==0)
                {
                    $("#RegisterError").html("<center>Please Enter Name</center>");
                }
                else if(Username.length==0)
                {
                    $("#RegisterError").html("<center>Please Enter Username</center>");
                }
                else if(Password.length==0)
                {
                    $("#RegisterError").html("<center>Please Enter Password</center>");
                }
                else if(Email.length==0)
                {
                    $("#RegisterError").html("<center>Please Enter EmailAddress</center>");
                }
                else if(Mobile.length==0)
                {
                     $("#RegisterError").html("<center>Please Enter MobileNumber</center>");
                }
            }
           
           return false;
       }
      
      
               
    </script>
        
  </head>
  <body>
      <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1618469181798703',
      xfbml      : true,
      version    : 'v2.6'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
      <?php include './view/title.php'; ?>
      
      <div class="container">
          
          <div class="col-md-6">
              <small>Login Here</small>
              <form method="post" class="form-group" name="login_form" onsubmit="return Loginchk()">
                  <input type="text" class="form-control" placeholder="Email or Mobile" id="Login_emailmobile" name="Login_emailmobile"> 
                  <input type="password" class="form-control" placeholder="Password"  id="Login_password" name="Login_password">
                  <a href="forget.php" class="">Forget Password..!</a>
                  <div class="alert-warning" id="LoginError"></div>
                  <input type="submit"  value="Login"  class="btn btn-primary form-control" id="btn_login" name="btn_login">
                  
              </form>
              <small>Create New Account</small>
              <form method="post" class="form-group" onsubmit="return Registerchk()">
                  <input type="text" class="form-control" placeholder="Name" id="Name" name="Name"> 
                  <input type="text" class="form-control" placeholder="Username" id="Username" name="Username"> 
                  <input type="password" class="form-control" placeholder="Password" id="Password" name="Password"> 
                  <input type="email" class="form-control" placeholder="Email" id="Email" name="Email"> 
                  <input type="number" class="form-control" placeholder="Mobile" id="Mobile" name="Mobile"> 
                  
                  
                  <div class="input-group">
                      <span class="">
                          <input type="radio"name="gender" required="" value="Male"/>
                      </span>
                      <x readonly class="">Male </x>
                      <span class="">
                          <input style="margin-left: 20px;" type="radio" name="gender" value="Female" />
                      </span>
                      <x readonly class="">Female </x>
                  </div>
                  
                  <!--<input style="margin-left: 20px;" type="radio" name="gender" value="Female" />Female-->
                  
                  
                  
                  <div class="alert-warning" id="RegisterError"></div>
                  <input type="submit" value="Register" class="btn btn-success form-control" id="btn_register" name="btn_register">
              </form>
              <small>
                  You can find out your friends and other people also you can request code solution's and project<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>
                  
              </small>
          </div>
          
          <div class="col-md-6">
              <a href="index.php?apk=ok"><img src="graphics/AndyNew.png" style="width:300px"> </a>
          </div>
      </div>
  <br/><br/><center>Project's List</center><br/><br/>
      <div class="container">
          <div class = "container-fluid row">
   <?php
           $q = mysql_query("select * from `projectdev`");
           while($data = mysql_fetch_array($q))
           {
   ?>
            <div class = "col-sm-6 col-md-3">
               

               <div class = "caption">
                  <h3><?php echo $data['protitle'];?></h3>
                  <p> <?php echo $data['forntend'];?></p>
                  <p> <?php echo $data['backend'];?></p>
                  <p>Status (<?php echo $data['status'];?>)</p>
                  <p><small>This Project Requested By </small><br/> <?php echo $data['fullname'];?></p>
                  
                  <p>
                     <a href = "#" class = "btn btn-primary" role = "button">
                        Dowload
                     </a> 

                     <a href = "#" class = "btn btn-default" role = "button">
                        Show Document's
                     </a>
                  </p>

               </div>
            </div>
    <?php
           }
    ?>
          </div>
      </div>
      
  <br/><br/>
  <center><small>Search with Front End</small> </center>
  <div class='container'>
      <a class='btn btn-warning' href="">Asp .Net</a>    
  <a class='btn btn-warning' href="">JAVA</a>
  <a class='btn btn-warning' href="">C# .Net</a>
  <a class='btn btn-warning' href="">PHP</a>
  <a class='btn btn-warning' href="">JSP</a>
  <a class='btn btn-warning' href="">Other</a>
      
  </div>

  <br/><br/>
  <center><small>Search with Back End </small> </center>
  <div class='container'>
      <h4>
  <a class='btn btn-warning' href="">Oracle</a>    
  <a class='btn btn-warning' href="">MySQL</a>
  <a class='btn btn-warning' href="">MsSQL</a>
  <a class='btn btn-warning' href="">Access</a>
  <a class='btn btn-warning' href="">Text File</a>
  <a class='btn btn-warning' href="">Other</a>
  </h4>
  </div>
  
    
  </body>
</html>
<?php
if(isset($_REQUEST["btn_login"]))
{
    
    $user = $_REQUEST["Login_emailmobile"];
    $passwd = $_REQUEST["Login_password"];
    if(($user!=null && $user!="")&&($passwd!=null && $passwd!=""))
    {
        $u =mysql_escape_string($_REQUEST["Login_emailmobile"]);
        $p =mysql_escape_string($_REQUEST["Login_password"]);
        $row=mysql_query("select * from members where email='$u' and password='$p' and active='1'");
        $count= mysql_num_rows($row);
        if($count==0)
        {
                $row=mysql_query("select * from members where mobile='$u' and password='$p' and active='1' ");
                $count= mysql_num_rows($row);
                if($count==0)
                {
                   ?><script>
                          var e = document.getElementById("LoginError").innerHTML="<center>User not found</center>"; 
                     </script><?php
                   
                }
                else
                {
                    $arr= mysql_fetch_array($row);
                    $_SESSION["user"]=$arr["email"];
                    $_SESSION["UID"]=$arr["id"];
                    //header("Location: home.php");
                   echo "<script>window.location='home.php'</script>";
                }
        }
        else
        {
                    $arr= mysql_fetch_array($row);
                    $_SESSION["user"]=$arr["email"];
                    $_SESSION["UID"]=$arr["id"];
                    //header("Location: home.php");
                  echo "<script>window.location='home.php'</script>";
        }
        
        
    }
    
}
if(isset($_REQUEST["btn_register"]))
{
    $nm = mysql_escape_string($_REQUEST["Name"]);
    $user = mysql_escape_string($_REQUEST["Username"]);
    $pass = mysql_escape_string($_REQUEST["Password"]);
    $email = mysql_escape_string($_REQUEST["Email"]);
    $mobile = mysql_escape_string($_REQUEST["Mobile"]);
    $gender = $_REQUEST["gender"];
    if($gender=="Male")
    {
        $img="userMale.png";
    }
    else
    {
        $img="userFemale.png";
    }
    if(mysql_query("INSERT INTO `members`( `name`, `username`, `password`, `email`, `mobile`,`active`,`gender`,`profileimg`,`coverimg`) VALUES ('$nm','$user','$pass','$email','$mobile','1','$gender','$img','coverimg.jpg')"))
    {
        
        $row=mysql_query("select * from members where email='$email' and password='$pass' and active='1'");
        $arr= mysql_fetch_array($row);
        $_SESSION["UID"]=$arr["id"];
        $_SESSION["user"]=$email;
        //auto generat welcome mgs in inbox
        $msg="Thank You for register.! you can replay me if you want ;)";
        $dt=date("Y-m-d H:i:s");
                
        mysql_query("INSERT INTO `msg`(`to`, `from`, `message`, `dt`, `status`) VALUES ('$_SESSION[UID]','4','$msg','$dt','send')");
        
            $to = "$email";
             $subject = "AshuSharma.com Thank you for.." ;
             $body = ""
                     . "You can login with your mobile and email address <br/>"
                     . "your password: $pass <br/><br/> if you wanted to project.<br/> request on http://ashusharma.com/project.php<br/> "
                     . "<a href='ashusharma.com'>Unsubscribe</a>";

                $headers = 'From:Ashu@AshuSharma.com' . "\r\n" ;
                $headers .='X-Mailer: PHP/' . phpversion();
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";   
                if(mail($to, $subject, $body,$headers)) 
                {
        //echo "<script>alert('Mail Send')</script>";            
              } 
              else 
              {
          //    echo "<script>alert('Mail Not Send')</script>";            //not send
              }
        
        
        echo "<script>window.location='home.php'</script>";
    }
    else
    {
        
        ?>
                     <script>
                          $("#RegisterError").html("<center>Ooos error please try agine.</center>");
                     </script>
                     
        <?php
    }
}




if(isset($_REQUEST["apk"]))
{   
    $info="";
    foreach($_SERVER as $key => $value){
    $info.= '$_SERVER["'.$key.'"] = '.$value."<br />";
    }
 
    $dt=date("Y-m-d H:i:s");

    mysql_query("INSERT INTO `apkdownload`(`info`,`dt`) VALUES ('$info','$dt')");
    
    echo "<script>window.location='ProjectDev.apk'</script>";
  }

?>