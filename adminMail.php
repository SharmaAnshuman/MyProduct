

<form method="post">
<textarea name="msg">Your mgs</textarea><br/>
<input type="email" placeholder="email" name="email"><br/>
<input type="submit" name="btn" value="Send Mail" />
</form>
<?php

if(isset($_REQUEST['btn']))
{
        $to= $_REQUEST['email'];
        $msg= $_REQUEST['msg'];
 
             
             $subject = "AshuSharma.com You have one Notification.." ;
             /*$body = ""
                     ."Welcome to"
                     . "if you wanted to project.<br/> request on http://ashusharma.com/project.php<br/> "
                     . "<a href='ashusharma.com'>Unsubscribe</a>  <small>::AshuSharma::</small>";*/
             $body ="<div dir='ltr'><div class='adM'>
</div><p style='margin:1em 0'>
<b>Welcome to AshuSharma.com!</b> You can login to your account at <span dir='ltr'><a href='http://ashusharma.com/' target='_blank'>AshuSharma.com</a></span>.
</p>
<p style='margin:1em 0'>
Here are a couple of tips to help you get started:
</p>
<ul>
    <li><b><a href='http://ashusharma.com/project.php'> for MCA BCA Project click here</b></a></li>
    <li><b><a href='http://ashusharma.com/index.php?apk=ok'>Download the mobile app</b> for Android to stay connected on the go.</a></li>
</ul>

<p style='margin:1em 0'>
Enjoy!
</p>
<p style='margin:1em 0'>
AshuSharma.com
</p>
<br>
<hr>
If you didn't create this Gmail address and don't recognize this email,
please visit: <a href='ashusharma.com'>Register</a>
</div>";

                $headers = 'From:Ashu@AshuSharma.com' . "\r\n" ;
                $headers .='X-Mailer: PHP/' . phpversion();
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";   
                if(mail($to, $subject, $body,$headers)) 
                {
        echo "<script>alert('Mail Send')</script>";            
              } 
              else 
              {
            echo "<script>alert('Mail Not Send')</script>";            //not send
              }
        
}
?>