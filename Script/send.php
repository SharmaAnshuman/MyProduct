<?php
session_start();
include '../config.php';
if(isset($_REQUEST["to"]))
{
  $msg = $_REQUEST["msg"];  
  $to = $_REQUEST["to"];
  $from = $_SESSION["UID"];
  //2012-04-24 7:45:12
  $dt=date("Y-m-d H:i:s");
  if($to!=$from)
  {
    mysql_query("INSERT INTO `msg`(`to`, `from`, `message`, `dt`, `status`) VALUES ('$to','$from','$msg','$dt','send')");
  }
  else
  {
      header("location: error.php");
  }
}
 else {
    header("location: ../error.php");
}


?>