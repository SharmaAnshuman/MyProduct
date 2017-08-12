<?php

                                        $subject="Forgot Password of www.ashusharma.com website's account";
					$from="mail@ashusharma.com";
					$body="Hi, <br/> <br/>Your User name is _____________ <br>Email ID :_____________<br>Password :________<br/>";
					
                                        $headers="From: ".strip_tags($from)."\r\n";
					$headers.="MIME-Version: 1.0\r\n";
					$headers.="Content-Type: text/html; charset=ISO-8859-1\r\n";
					if(mail("bestashu2010@gmail.com",$subject,$body,$headers))
					{
						echo "<div class='alert-success'>Your account password has been sent to your e-mail address. Check your e-mail's inbox/spam box</div>";
					}
					else
					{
						echo "<div class='wrong'><span>Your password can't sent to your e-mail.</span></div>";
					}
  
  
  
  ?>

