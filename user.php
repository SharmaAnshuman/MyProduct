<?php
session_start();
if(isset($_SESSION["user"]))
{
    if($_SESSION["UID"]===$_REQUEST["user"])
    {
         header("Location: index.php"); 
    }
}
else
{
  header("Location: index.php");  
}
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
       <?php
 $email = $_REQUEST["user"];

            $row=mysql_query("select * from `members` where id='$email' ");
            $arr=mysql_fetch_array($row);
        ?>
      
      <div class="col-md-12">
      <!-- cover photo -->
      
         <div class="jumbotron container" style="height: 250px;padding:9px" id="uploadCoverPic" >
            <img src="userPic/<?php echo $arr["coverimg"]; ?>" style="background-image:url(graphics/default-cover.png);" height="100%" width="100%">
            <h3><span class="pull-right" style="margin-top:-60px;margin-right: 10px;cursor: pointer" id="CoverPic"></span></h3>
                      <img src="userPic/<?php echo $arr["profileimg"]; ?>" height="120px" width="120px" style="background-image:url(graphics/default-cover.png);margin-left: 10px;margin-top:-150px;border:none;box-shadow:0px 1px 5px 1px black" id="uploadProfilePic" />
            
            <span class="" style="cursor: pointer;margin-left: 10px;padding-top: 5px;margin-left: -120px"id="ProfilePic"></span>
            <x style=""><?php 
            echo ucfirst($UserName=$arr["name"]);
            ?></x>
       
             
                        
        </div>
           
             
      </div>
      <div class="container">
      <span style="margin-left: 0px" class='glyphicon glyphicon-send'></span> <a  class="" href="sendmessage.php?to=<?php echo $email;?>">Send Message</a><br/>
      <?php
                            $result =mysql_query("select * from `friends` where (`sender`=$_SESSION[UID] and `receiver`=$email) or (`sender`=$email and `receiver`=$_SESSION[UID])");
                            $co1 = mysql_num_rows($result);
                            if($co1==0)
                            {
                                ?>
      <span style="margin-left:0px" class='glyphicon glyphicon-fire'></span> <a id='btnAddFri' style="text-decoration: none" class="" href="Script/becomefrnd.php?token=<?php echo $email; ?>">Add To Circle</a><br/>
                                <script>
                                    $("#btnAddFri").click(function()
                                    {
                                        $("#btnAddFri").text("Request Send..!");
                                    });
                                </script>
                                    
                                    <?php
                            }
                            
                            $result =mysql_query("select * from `friends` where `sender`=$_SESSION[UID] and `receiver`=$email and `status`='panding'");
                            $co1 = mysql_num_rows($result);
                            if($co1==1)
                            {
                                $dataX = mysql_fetch_array($result);
                                ?>
                                <span style="margin-left:0px" class='glyphicon glyphicon-fire'></span> <a id='btnAddFri' style="text-decoration: none" class="" href="Script/becomefrnd.php?NOT=<?php echo $dataX['id']; ?>">Cancle Request.!</a><br/>
                                <?php
                            }
                            $result =mysql_query("select * from `friends` where `sender`=$email and `receiver`=$_SESSION[UID] and `status`='panding'");
                            $co1 = mysql_num_rows($result);
                            if($co1==1)
                            {
                                $aq = mysql_fetch_array($result);
                                ?>
                                    <span style="margin-left:0px" class='glyphicon glyphicon-fire'></span> <small>You Received Friend Request</small>            
                                    &nbsp;&nbsp;<a href="Script/becomefrnd.php?OK=<?php echo $aq['id']; ?>" class="btn btn-sm btn-success">Add</a>&nbsp;<a href="Script/becomefrnd.php?NOT=<?php echo $aq['id']; ?>" class="btn btn-sm btn-default">Delete</a><br/>
                                <?php
                                
                            }
                            $result =mysql_query("select * from `friends` where ((`sender`=$email and `receiver`=$_SESSION[UID]) or (`sender`=$_SESSION[UID] and `receiver`=$email)) and `status`='ok'");
                            $co1 = mysql_num_rows($result);
                            if($co1==1)
                            {
                                //echo "unfrnd";
                                ?>
                                                                        <span style="margin-left:0px" class='glyphicon glyphicon-fire'></span> 
                                                                        <a href="Script/becomefrnd.php?NOT=<?php echo $aq['id']; ?>" style="color:red" >Unfriend</a><br/>
                                    <?php
                            }
                            
                            echo mysql_error();
                            
                          ?>
      
                                                                        <span style="margin-left:0px" class='glyphicon glyphicon-info-sign'></span> <a  class="" href="AboutUser.php?token=<?php echo $email; ?>"><small>About <?php  echo ucfirst($UserName);?></small></a>
      </div>
            
      <br/>
       
    <div class="container" >   
        <div class="col-md-2">
               <div class="panel panel-primary">
                   <div aria-expanded="true" class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="cursor: pointer">
                       <h4 class="panel-title">
                           <a style="text-decoration: none;" aria-expanded="true" data-toggle="collapse" data-parent="#accordion" href="#collapse2"><?php  echo ucfirst($UserName);?>'s Friends</a>
                       </h4>
                   </div>
                   <div aria-expanded="true" style="" id="collapse2" class="panel-collapse collapse in">
                       <div class="panel-body">
                           
                           <?php
                           $result = mysql_query("SELECT * FROM `friends` where (`receiver`='$email' or `sender`='$email') and `status`='ok' limit 3");
                           $re1tot = mysql_num_rows($result);
                           if($re1tot == 0)
                           {
                               echo "Not Found";
                           }
                           else
                           {
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
                           ?><hr><center><a href="see" style="text-decoration: none" id='ShowFRD' data-toggle="modal" data-target="#SeeMore"><span class="glyphicon glyphicon-user"></span> See All..</a></center>
                           <script>
                               $("#ShowFRD").click(function()
                               {    
                                   $.post("Script/SeeAll.php",{seeAllTokent:<?php echo $email;?>},function(data)
                                   {
                                       $("#data<?php echo $email;?>").html(data);
                                   });
                                   
                               });
                           </script>
                                                                            <div id="SeeMore" class="modal fade" role="dialog">
                                                                            <div class="modal-dialog">

                                                                              <!-- Modal content-->
                                                                              <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                  <h4 class="modal-title"><?php   echo ucfirst($dataOfuser['name'])."' Friends"; ?></h4>
                                                                                </div>
                                                                                <div class="modal-body" id='data<?php echo $email;?>'>
                                                                                  <p>Loading..</p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                </div>
                                                                              </div>

                                                                            </div>
                                                                          </div>
                                
                               <?php
                           }
                           ?>
                               
                          
                       </div>
                   </div>
               </div>
          </div>
           <div class="col-md-7">
             
                  <?php
                  $row = mysql_query("select * from `posts` where `userid`='$email' order by id desc");
                  if(mysql_num_rows($row)==0)
                  {
                      echo "<center>$UserName not posted anything..!</center>";
                  }
                  
                  while($data=  mysql_fetch_array($row))
                  {
                      $row1=mysql_query("select * from `members` where id=$data[userid]");
                      $udata = mysql_fetch_array($row1);
                      if($data["type"]=="Error")
                      {
                                          ?>
                            <div class="panel panel-danger">

                                <div class="panel-heading"><a href="user.php?user=<?php echo $data["userid"];?>"><?php echo ucfirst($udata["name"]); ?></a><small class="pull-right"><?php $date = date_create($data['dt']); echo date_format($date, 'd-M H:i a'); ?></small></div>
                                <div class="panel-body">
                                    
                                        <?php
                                        echo $data["post"];
                                        ?>
                                    
                                     <div id="x1<?php echo $data['id']; ?>"  class="collapse">
                                         <hr>
                                         <!--<a ><span class="glyphicon glyphicon-arrow-up"> </span>Show All Comments</a>-->
                                         <div style="padding: 10px">
                                             <?php
                                              $rowComm = mysql_query("SELECT `id`, `postsid`, `userid`, `comments`, `dt` FROM `comment` WHERE `postsid`='$data[id]' ");
                                              if(mysql_num_rows($rowComm)==0)
                                              {
                                                  ?>
                                              <com>
                                                  <center>you have solution</center>
                                              </com>
                                              <?php

                                              }
                                              while ($CommArr = mysql_fetch_array($rowComm))
                                              {
                                              $RowUser = mysql_query("SELECT * FROM `members` WHERE `id`=$CommArr[userid] ");
                                              $UData  = mysql_fetch_array($RowUser);
                                                  ?>
                                                   <com>
                                                       <p style="margin-bottom: -1px"><span class="glyphicon glyphicon-user"></span> <?php echo $UData['name']; ?> <small><?php $date = date_create($CommArr['dt']); echo date_format($date, 'H:i a'); ?></small>
                           <?php if($_SESSION['UID']==$CommArr['userid'])
                           {
                               ?><span class="glyphicon glyphicon-remove" style="cursor: pointer" onclick="delComm('<?php echo $CommArr['id']; ?>','<?php echo $CommArr['postsid']; ?>');"></span><?php
                           }
                          else 
                          {

                          }
                          ?>
                                                          </p>
                                                       <commnet style="padding: 10px;margin-left:9px;color: white"><?php echo $CommArr['comments'];?></commnet>
                                                   </com>
                                                  <?php
                                              }
                                             ?>
                                         </div>
                                         <textarea class="form-control" id="CommentMgs<?php echo $data['id']; ?>"></textarea>
                                         <button class='btn btn-sm btn-info' onclick="CommentIt('<?php echo $data['id']; ?>')">Send Code</button>
                                      </div>
                                </div>
                                <div class="panel-footer">
                                    <?php
                                    //Getting user like or Unlike
                                    $RowLike= mysql_query("select * from `like` where `userid`='$_SESSION[UID]' and `postsid`='$data[id]' ");
                                    if(mysql_num_rows($RowLike)==0)
                                    {   $Cheer="  <span class='glyphicon glyphicon-thumbs-up'></span>";    }
                                    else
                                    {   $Cheer="<span class=''>Unlike</span>";    }
                                    ?>
                                    <button class=" " style="background-color: transparent;border: none" id='btn_nice<?php echo $data["id"]; ?>' value="<?php echo $data["id"]; ?>"><?php echo $Cheer; ?> <span class="badge"><?php echo $data["like"]; ?></span></button>
                                    <?php
                                    $RowTotCom = mysql_query("SELECT count(*)as `totCom` FROM `comment` WHERE `postsid`='$data[id]'");
                                    $TotCom = mysql_fetch_array($RowTotCom);
                                    
                                    ?>
                                    <button style="background-color: transparent;border: none" data-toggle="collapse" data-target="#x1<?php echo $data['id']; ?>">Comment<span class="badge"><?php echo $TotCom['totCom'];  ?></span></button>





                                    <script>
                                         $("#btn_nice<?php echo $data["id"]; ?>").click(function()
                                          {


                                              var postIDI=$("#btn_nice<?php echo $data["id"]; ?>").val();

                                              $.post("Script/like.php",{id:postIDI},function(data1)
                                              {
                                                  if(data1=="Like")
                                                  {
                                                      window.location='home.php';
                                                  }
                                                  else
                                                  {
                                                      window.location='home.php';
                                                  }


                                              });

                                          });
                                    </script>
                                    <?php
                                    if($_SESSION["UID"]===$udata["id"])
                                    {

                                    }
                                    else 
                                    {
                                    ?>
                                    <small><a href="sendmessage.php?to=<?php echo $data["userid"];?>" style="background-color: transparent;border: none">Talk to <?php $info= substr($udata["name"], 0,7).".."; echo ucfirst($info); ?></a></small>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                                <?php
                      }
                      else
                      {
                                ?>
                            <div class="panel panel-primary">

                                <div class="panel-heading"><a href="user.php?user=<?php echo $data["userid"];?>"><?php echo ucfirst($udata["name"]); ?></a><small class="pull-right"><?php $date = date_create($data['dt']); echo date_format($date, 'd-M H:i a'); ?></small></div>
                                <div class="panel-body">
                                    <center>
                                        <?php
                                        echo $data["post"];
                                        ?>
                                    </center>
                                     <div id="x1<?php echo $data['id']; ?>"  class="collapse">
                                         <hr>
                                         <!--<a ><span class="glyphicon glyphicon-arrow-up"> </span>Show All Comments</a>-->
                                         <div style="padding: 10px">
                                             <?php
                                              $rowComm = mysql_query("SELECT `id`, `postsid`, `userid`, `comments`, `dt` FROM `comment` WHERE `postsid`='$data[id]' ");
                                              if(mysql_num_rows($rowComm)==0)
                                              {
                                                  ?>
                                              <com>
                                                  <center>be the first to comment</center>
                                              </com>
                                              <?php

                                              }
                                              while ($CommArr = mysql_fetch_array($rowComm))
                                              {
                                              $RowUser = mysql_query("SELECT * FROM `members` WHERE `id`=$CommArr[userid] ");
                                              $UData  = mysql_fetch_array($RowUser);
                                                  ?>
                                                   <com>
                                                       <p style="margin-bottom: -1px"><span class="glyphicon glyphicon-user"></span> <?php echo $UData['name']; ?> <small><?php $date = date_create($CommArr['dt']); echo date_format($date, 'H:i a'); ?></small>
                           <?php if($_SESSION['UID']==$CommArr['userid'])
                           {
                               ?><span class="glyphicon glyphicon-remove" style="cursor: pointer" onclick="delComm('<?php echo $CommArr['id']; ?>','<?php echo $CommArr['postsid']; ?>');"></span><?php
                           }
                          else 
                          {

                          }
                          ?>
                                                          </p>
                                                       <commnet style="padding: 10px;margin-left:9px;color: white"><?php echo $CommArr['comments'];?></commnet>
                                                   </com>
                                                  <?php
                                              }
                                             ?>
                                         </div>
                                         <textarea class="form-control" id="CommentMgs<?php echo $data['id']; ?>"></textarea>
                                         <button class='btn btn-sm btn-info' onclick="CommentIt('<?php echo $data['id']; ?>')">Murmur</button>
                                      </div>
                                </div>
                                <div class="panel-footer">
                                    <?php
                                    //Getting user like or Unlike
                                    $RowLike= mysql_query("select * from `like` where `userid`='$_SESSION[UID]' and `postsid`='$data[id]' ");
                                    if(mysql_num_rows($RowLike)==0)
                                    {   $Cheer="  <span class='glyphicon glyphicon-thumbs-up'></span>";    }
                                    else
                                    {   $Cheer="<span class=''>Unlike</span>";    }
                                    ?>
                                    <button class=" " style="background-color: transparent;border: none" id='btn_nice<?php echo $data["id"]; ?>' value="<?php echo $data["id"]; ?>"><?php echo $Cheer; ?> <span class="badge"><?php echo $data["like"]; ?></span></button>
                                    <?php
                                    $RowTotCom = mysql_query("SELECT count(*)as `totCom` FROM `comment` WHERE `postsid`='$data[id]'");
                                    $TotCom = mysql_fetch_array($RowTotCom);
                                    
                                    ?>
                                    <button style="background-color: transparent;border: none" data-toggle="collapse" data-target="#x1<?php echo $data['id']; ?>">Comment <span class="badge"><?php echo $TotCom['totCom'];  ?></span></button>




                                    <script>
                                         $("#btn_nice<?php echo $data["id"]; ?>").click(function()
                                          {


                                              var postIDI=$("#btn_nice<?php echo $data["id"]; ?>").val();

                                              $.post("Script/like.php",{id:postIDI},function(data1)
                                              {
                                                  if(data1=="Like")
                                                  {
                                                      window.location='home.php';
                                                  }
                                                  else
                                                  {
                                                      window.location='home.php';
                                                  }


                                              });

                                          });
                                    </script>
                                    <?php
                                    if($_SESSION["UID"]===$udata["id"])
                                    {

                                    }
                                    else 
                                    {
                                    ?>
                                    <small> <a href="sendmessage.php?to=<?php echo $data["userid"];?>" style="background-color: transparent;border: none">Talk to <?php $info= substr($udata["name"], 0,7).".."; echo ucfirst($info); ?></a></small>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                                <?php
                      }
                  }
                  ?>
                  
              
              
          </div>
      </div>
   
      
  </body>
</html>
