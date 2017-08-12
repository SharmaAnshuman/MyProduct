<?php
session_start();
include '../config.php';
if(isset($_SESSION["user"]))
{
    if(isset($_REQUEST["token"]))
    {
        if ($_SESSION["UID"]!=$_REQUEST["token"])
        {
            $Q = mysql_escape_string($_REQUEST["token"]);
            $dt = date("Y-m-d H:i:s");
            $row = mysql_query("select * from `friends` where `sender`='$_SESSION[UID]' and `receiver`='$Q'");
            $totFound = mysql_num_rows($row);
            if($totFound==0)
            {
            mysql_query("INSERT INTO `friends`(`sender`, `receiver`, `status`, `dt`) VALUES ('$_SESSION[UID]','$Q','panding','$dt')");
            }
            echo "<script>history.back();</script>";
           
        }
    }
    elseif(isset($_REQUEST["tokenRemove"]))
    {
        if ($_SESSION["UID"]!=$_REQUEST["tokenRemove"])
        {
            $Q = mysql_escape_string($_REQUEST["tokenRemove"]);
            mysql_query("DELETE FROM `friends` WHERE `sender`=$_SESSION[UID] and `receiver`=$Q  or `receiver`=$_SESSION[UID] and `sender`=$Q");
            echo "<script>history.back();</script>";
            //header("Location: ../user.php?user=".$_REQUEST['tokenRemove']."");
        }
    }
    
    if(isset($_REQUEST["OK"]))
    {
        $OK= mysql_escape_string($_REQUEST["OK"]);
        mysql_query("update `friends` set `status` = 'ok' where id=$OK");
        echo "<script>history.back();</script>";
        //header("Location: ../home.php");
    }
    if(isset($_REQUEST["NOT"]))
    {
        $OK= mysql_escape_string($_REQUEST["NOT"]);
        mysql_query("delete from `friends` where id=$OK");
        echo "<script>history.back();</script>";
        //header("Location: ../home.php");
    }    
    
}
else
{
    
    header("Location: ../erroe.php");
}

?>