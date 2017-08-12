<?php

include '../config.php';
$email = $_REQUEST['seeAllTokent'];
$result = mysql_query("SELECT * FROM `friends` where (`receiver`='$email' or `sender`='$email') and `status`='ok'");
                           while($dtUSER = mysql_fetch_array($result))
                           {
                               if($dtUSER['receiver']!=$email)
                               {
                                   
                                   $q1 = mysql_query("select * from `members` where `id`=$dtUSER[receiver]");
                                   $dataOfuser = mysql_fetch_array($q1);
                                   echo ucfirst($dataOfuser['name'])."<br/>";
                               }   
                               else if($dtUSER['sender']!=$email)
                               {
                                   
                                   $q1 = mysql_query("select * from `members` where `id`=$dtUSER[sender]");
                                   $dataOfuser = mysql_fetch_array($q1);
                                   echo ucfirst($dataOfuser['name'])."<br/>";
                               }
                                
                           }
?>