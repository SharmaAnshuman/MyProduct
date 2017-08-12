<?php
   session_start();
   include '../config.php';
   $email = $_SESSION["user"];
   $row=mysql_query("select * from `members` where email='$email' ");
   $arr=mysql_fetch_array($row);
   $Userid=$arr["id"];
   $file_name="";
        if(isset($_REQUEST["btn_profilePic"]))
        {
            //print_r($_FILES["profilePic"]);   
             if(isset($_FILES['profilePic']))
             {
                $errors= array();
                $file_name = $_FILES['profilePic']['name'];
                $file_size =$_FILES['profilePic']['size'];
                $file_tmp =$_FILES['profilePic']['tmp_name'];
                $file_type=$_FILES['profilePic']['type'];
                $file_ext=strtolower(end(explode('.',$_FILES['profilePic']['name'])));

                $expensions= array("jpeg","jpg","png");

                if(in_array($file_ext,$expensions)=== false){
                   $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                }

                if($file_size > 2097152){
                   $errors[]='File size must be excately 2 MB';
                }

                if(empty($errors)==true)
                {
                    $file_name=$Userid."Profile.jpg";
                   move_uploaded_file($file_tmp,"../userPic/".$file_name);
                   echo "Success";
                }else
                {
                   print_r($errors);
                }
             }
        mysql_query("update `members` set profileimg='$file_name' where id=$Userid");
        header("Location: ../home.php");
    }
   else if(isset($_REQUEST["btn_coverPic"]))
    {
        
             if(isset($_FILES['coverPic']))
             {
                $errors= array();
                $file_name = $_FILES['coverPic']['name'];
                $file_size =$_FILES['coverPic']['size'];
                $file_tmp =$_FILES['coverPic']['tmp_name'];
                $file_type=$_FILES['coverPic']['type'];
                $file_ext=strtolower(end(explode('.',$_FILES['coverPic']['name'])));

                $expensions= array("jpeg","jpg","png");

                if(in_array($file_ext,$expensions)=== false){
                   $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                }

                if($file_size > 2097152){
                   $errors[]='File size must be excately 2 MB';
                }

                if(empty($errors)==true)
                {
                    $file_name=$Userid."Cover.jpg";
                   move_uploaded_file($file_tmp,"../userPic/".$file_name);
                   
                }else
                {
                  
                }
             }
        mysql_query("update `members` set coverimg='$file_name' where id=$Userid");
        header("Location: ../home.php");
    }
    else
    {
        header("Location: ../home.php");
       
    }
?>