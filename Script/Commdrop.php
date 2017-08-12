<?php
    session_start();
    if(isset($_SESSION["user"]) && isset($_SESSION["UID"]))
    {
        include '../config.php';
        $commId= $_REQUEST["commid"];
        $postId= $_REQUEST["postid"];
        $q= "DELETE FROM `comment` WHERE `id`='$commId' and `postsid`='$postId' and `userid`='$_SESSION[UID]'";
        mysql_query($q);
        
    }
 else {
           header("Location: ../index.php");
}
?>