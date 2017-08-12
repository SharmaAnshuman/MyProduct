<?php
session_start();
if(isset($_SESSION["user"]) && isset($_SESSION["UID"]))
  {
      
  }
  else
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
    <title>Ashu Sharma</title>
    <link rel="icon" type="image/gif" href="graphics/ashu.ico" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function()
        {
          $("#ProfilePic").click(function()
           {
               $("#profilePicModal").modal('show');
           });
           
           $("#CoverPic").click(function()
           {
               $("#coverPicModal").modal('show');
           });
           
          
        });
        function postShare()
        {
            var c=$("#shareTxt").val();
            
            if(c==="" || c===" ")
            {
                alert("Enter Details to Post");
            }
            else
            {
                if(c.length<5)
                {
                    alert("Check Post Length..!");
                }
                else
                {
                    var zxc =  $('input[name="s"]:checked').val();
                   
                    
                    $.post("Script/post.php",{post:c,protype:zxc},function(data)
                    {
                       if(data == "Posted")
                       {
                           window.location='home.php';
                       }
                       else
                       {
                           window.location='home.php';
                       }
                    });
                }
            }
        }
        
        function CommentIt(ppp)
        {
            
            var mmm = $("#CommentMgs"+ppp).val();
            
            $.post("Script/comments.php",{pid:ppp,mgs:mmm},function(data){
                           window.location='home.php';
            });
            
        }
        function delComm(cidc,pidp)
        {
            var cid = cidc;
            var pid = pidp;
            $.post("Script/Commdrop.php",{commid:cid,postid:pid},function(data)
            {
                window.location='home.php';
            });
        }
        
    </script>
  </head>
  <body>
      <?php include './view/title.php';?>
         <?php
 $email = $_SESSION["user"];
            $row=mysql_query("select * from `members` where email='$email' ");
            $arr=mysql_fetch_array($row);
        ?>
        
      <div class="col-md-12">
      <!-- cover photo -->
      
        <div class="jumbotron container" style="height: 250px;padding:9px" id="uploadCoverPic" >
            <img src="userPic/<?php echo $arr["coverimg"]; ?>" style="background-image:url(graphics/default-cover.png);" height="100%" width="100%">
            <h3><span class="glyphicon glyphicon-pencil pull-right" style="margin-top:-60px;margin-right: 10px;cursor: pointer" id="CoverPic">CoverPic</span></h3>
                      <img src="userPic/<?php echo $arr["profileimg"]; ?>" height="120px" width="120px" style="background-image:url(graphics/default-cover.png);margin-left: 10px;margin-top:-150px;border:none;box-shadow:0px 1px 5px 1px black" id="uploadProfilePic" />
            
            <span class="glyphicon glyphicon-pencil" style="cursor: pointer;margin-left: 10px;padding-top: 5px;margin-left: -120px"id="ProfilePic"></span>
            <x style=""><?php 
            echo ucfirst($UserName=$arr["name"]);
            ?></x>
            <br/><a style="margin-left: 30px" href="project.php" class="">Project Helper</a>     
        </div>
        
      </div>
      <br/>
      
      <div>
      </div>
      
      <div>
          <br/>
      </div>
      <div class="container">
          
          <div class="col-md-7 col-md-offset-2">
          <textarea placeholder="if have an error in your project put here also you can share new ideas..!" class="form-control" id="shareTxt"></textarea>
          <input type="radio" value="Error" id="posttype" name="s" checked> Error <small>in code</small> <input type="radio" name="s" value="Idea" id="posttype"> idea<small> Sharing</small>  <button class="btn btn-success pull-right" onclick="postShare()">Share</button>
          </div>
      </div>
      
      
      <br/>
      <div class="container">       
          
          
         <div class="col-md-2">
               <div class="panel panel-primary">
                   <div aria-expanded="true" class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="cursor: pointer">
                       <h4 class="panel-title">
                           <a style="text-decoration: none;" aria-expanded="true" data-toggle="collapse" data-parent="#accordion" href="#collapse2">Your Friend's</a>
                       </h4>
                   </div>
                   <div aria-expanded="true" style="" id="collapse2" class="panel-collapse collapse in">
                      <div class="panel-body">
                           
                           <?php
                           $result = mysql_query("SELECT * FROM `friends` where (`receiver`='$_SESSION[UID]' or `sender`='$_SESSION[UID]') and `status`='ok' limit 3");
                           $re1tot = mysql_num_rows($result);
                           if($re1tot == 0)
                           {
                               echo "Make New firend ;-)";
                           }
                           else
                           {
                           while($dtUSER = mysql_fetch_array($result))
                           {
                               
                               if($dtUSER['sender']!=$_SESSION['UID'])
                               {
                                   
                                   $q1 = mysql_query("select * from `members` where `id`=$dtUSER[sender]");
                                   $dataOfuser = mysql_fetch_array($q1);
                                   echo ucfirst($dataOfuser['name'])."<br/>";
                               }
                               else if($dtUSER['receiver']!=$_SESSION['UID'])
                               {
                                   
                                   $q1 = mysql_query("select * from `members` where `id`=$dtUSER[receiver]");
                                   $dataOfuser = mysql_fetch_array($q1);
                                   echo ucfirst($dataOfuser['name'])."<br/>";
                               }   
                           }
                           ?><hr><center><a style="text-decoration: none" href="see" id='ShowFRD' data-toggle="modal" data-target="#SeeMore" ><span class="glyphicon glyphicon-user"></span> See All..</a></center>
                               <script>
                               $("#ShowFRD").click(function()
                               {    
                                   $.post("Script/SeeAll.php",{seeAllTokent:<?php echo $_SESSION['UID'];?>},function(data)
                                   {
                                       $("#data<?php echo $_SESSION['UID'];?>").html(data);
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
                                                                                <div class="modal-body" id='data<?php echo $_SESSION["UID"];?>'>
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
                  <div class="panel panel-primary">
                   <div aria-expanded="true" class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse3" style="cursor: pointer">
                       <h4 class="panel-title">
                           <a style="text-decoration: none;" aria-expanded="true" data-toggle="collapse" data-parent="#accordion" href="#collapse2"><small style="color:white">Suggested Friends</small></a>
                       </h4>
                   </div>
                   <div aria-expanded="true" style="" id="collapse3" class="panel-collapse collapse in">
                       <div class="panel-body">
                           
                       </div>
                   </div>
               </div>
          </div>
           <div class="col-md-7">
                  <?php
                  $row = mysql_query("select * from `posts` order by id desc");
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
                                         <button class='btn btn-sm btn-info' id='Btn_SendCode<?php echo $data['id']; ?>' onclick="CommentIt('<?php echo $data['id']; ?>')">Send Code</button>
                                         <Script>
                                             $("#Btn_SendCode<?php echo $data['id']; ?>").click(function()
                                             {
                                                 $("#Btn_SendCode<?php echo $data['id']; ?>").attr("disabled", true);
                                                 $("#Btn_SendCode<?php echo $data['id']; ?>").text("Sending..");
                                                 
                                             });
                                         </script>
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
                                              $("#btn_nice<?php echo $data["id"]; ?>").attr("disabled", true);


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
                                         <button class='btn btn-sm btn-info'id="Btn_Comm<?php echo $data['id']; ?>" onclick="CommentIt('<?php echo $data['id']; ?>')">Comment</button>
                                         <Script>
                                             $("#Btn_Comm<?php echo $data['id']; ?>").click(function()
                                             {
                                                 $("#Btn_Comm<?php echo $data['id']; ?>").attr("disabled", true);
                                                 $("#Btn_Comm<?php echo $data['id']; ?>").text("Wait..");
                                                 
                                             });
                                         </script>
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
                                              $("#btn_nice<?php echo $data["id"]; ?>").attr("disabled", true);


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
      <div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        
  </body>
</html>

<div id="coverPicModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Cover Pic</h4>
      </div>
      <div class="modal-body">
          <div class="alert">
              File size must be lessthen 2 MB <br/>
              please choose a JPEG,JPG or PNG file.
          </div>
          <script>
              function uploadCover()
              {
                    var imgVal = $('#up').val();
                    if(imgVal=='')
                    {
                        alert("Select Cover Pic");
                        return false;
                    }
                return true;
              }
               
          </script>
          <form action="Script/upload.php" method="post" onsubmit="return uploadCover()" enctype="multipart/form-data">
              <input type="file" name="coverPic" style="display: none" id="up"/>
              <label class="btn btn-warning" for="up">Select File</label>
              <input type="submit" value="Upload" name="btn_coverPic" class="btn btn-success">
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="profilePicModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Profile Pic</h4>
      </div>
      <div class="modal-body">
          <div class="alert">
              File size must be excately 2 MB<br/>
              please choose a JPEG,JPG or PNG file.
          </div>
          <script>
              function uploadProfile()
              {
                    var imgVal = $('#up1').val();
                    if(imgVal=='')
                    {
                        alert("Select Profile Pic");
                        return false;
                    }
                return true;
              }
               
          </script>
          <form action="Script/upload.php" method="post" onsubmit="return uploadProfile()" enctype="multipart/form-data">
              <input type="file" name="profilePic" style="display: none" id="up1"/>
              <label  class="btn btn-warning" for="up1">Select File</label>
              <input type="submit" value="Upload" name="btn_profilePic"  class="btn btn-success">
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>