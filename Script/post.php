<?php
session_start();
include '../config.php';
if(isset($_SESSION["user"]))
{
    if(isset($_REQUEST["post"]))
    {
        $post=  mysql_escape_string($_REQUEST["post"]);
        $protype = mysql_escape_string($_REQUEST["protype"]);
        if($post!=null || $post!="" || $post!=" ")
        {
            $email = $_SESSION["user"];
            $row=mysql_query("select * from `members` where email='$email' ");
            $arr=mysql_fetch_array($row);
            $Userid=$arr["id"];
            $dt = date("Y-m-d H:i:s");
            if(mysql_query("INSERT INTO `posts`(`userid`, `post`, `dt`,`like`,`active`,`type`) VALUES ('$Userid','$post','$dt','0','1','$protype')"))
            {
                echo "Posted";
            }
            else
            {
                echo "<script>alert('Error Try Agine..!');</script>";
            }
        }
    }
   
}
?>