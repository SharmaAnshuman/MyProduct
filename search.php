<?php
session_start();
if(isset($_REQUEST["searchIteam"]))
{
    
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
      <?php include './view/title.php';
      $qy = mysql_escape_string($_REQUEST["searchIteam"]);      
      $row = mysql_query("select * from `members` where name like '%$qy%' or email like '%$qy%'");
      
      ?>
       <div class="container">
           <div class='col-md-3'>
          <p>People</p>
          <?php
                $totUsr=mysql_num_rows($row);
          if($totUsr != 0)
          {
                  while ($data=  mysql_fetch_array($row))
                  {
                      if($_SESSION["UID"]!=$data["id"])
                      {
                    ?>
          <table class="table table-bordered">
              <tr>
                  <td><a href="user.php?user=<?php echo $data['id']; ?>"><img src="userPic//<?php echo $data["profileimg"] ?>" height="100px" width="100px"></a></td>
                  <td style="width: 90%">
                      <div style="padding: 5px;">
                          <p style="margin-top: -10px"><b><a href="user.php?user=<?php echo $data['id']; ?>" style="text-decoration: none"><?php echo ucfirst($data["name"]); ?></a></b></p>
                          <p style="margin-top: 0px"><?php echo $data['gender']; ?></p>
                          <p style="margin-top: 0px"><?php echo ""; ?></p>
                          <?php
                            $result =mysql_query("select * from `friends` where (`sender`=$_SESSION[UID] and `receiver`=$data[id]) or (`sender`=$data[id] and `receiver`=$_SESSION[UID])");
                            $co1 = mysql_num_rows($result);
                            if($co1==0)
                            {
                                ?><a id='btnAddFri<?php echo $data["id"]; ?>' class='btn btn-sm btn-primary' href="Script/becomefrnd.php?token=<?php echo $data['id']; ?>">Add To Circle</a>
                                <script>
                                    $("#btnAddFri<?php echo $data["id"]; ?>").click(function()
                                    {
                                        $("#btnAddFri<?php echo $data["id"]; ?>").text("Request Send..!");
                                    });
                                </script>
                                    
                                    <?php
                            }
                            
                            $result =mysql_query("select * from `friends` where `sender`=$_SESSION[UID] and `receiver`=$data[id] and `status`='panding'");
                            $co1 = mysql_num_rows($result);
                            if($co1==1)
                            {
                                $dataX = mysql_fetch_array($result);
                                ?><a href="Script/becomefrnd.php?NOT=<?php echo $dataX['id']; ?>" class="btn btn-sm btn-default">Cancle Request.!</a><?php
                            }
                            $result =mysql_query("select * from `friends` where `sender`=$data[id] and `receiver`=$_SESSION[UID] and `status`='panding'");
                            $co1 = mysql_num_rows($result);
                            if($co1==1)
                            {
                                $aq = mysql_fetch_array($result);
                                ?>
                                    <small>You Received Friend Request</small>              <br/>
                                    <a href="Script/becomefrnd.php?OK=<?php echo $aq['id']; ?>" class="btn btn-sm btn-success">Add</a>&nbsp;<a href="Script/becomefrnd.php?NOT=<?php echo $aq['id']; ?>" class="btn btn-sm btn-default">Delete</a>
                                <?php
                                
                            }
                            $result =mysql_query("select * from `friends` where ((`sender`=$data[id] and `receiver`=$_SESSION[UID]) or (`sender`=$_SESSION[UID] and `receiver`=$data[id])) and `status`='ok'");
                            $co1 = mysql_num_rows($result);
                            if($co1==1)
                            {
                                //echo "unfrnd";
                                ?><a href="Script/becomefrnd.php?tokenRemove=<?php echo $data['id']; ?>" class="btn btn-sm btn-danger">Unfriend</a><?php
                            
                            }
                            
                            echo mysql_error();
                            
                          ?>
                          
                      </div>
                  </td>
              
              </tr>
          </table>
           <?php
                      }
                  }
                  echo "<a href=''>See more..</a>";
          }
          else 
          {
                echo 'Not Found';
          }?>
           </div>
           <br/>
           <div class='col-md-6'>
               <p>Posts</p>
                <?php
                  $row = mysql_query("select * from `posts` where `post` like '%$qy%' order by id desc");
                  $TotalserchItem = mysql_num_rows($row);
                  if($TotalserchItem !=0)
                  {
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
                                </div>
                                <div class="panel-footer">
                                    <button class="btn btn-danger">View Full Posts</button>
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
                                </div>
                                     
                                <div class="panel-footer">
                                    <button class="btn btn-default">View Post</button>
                                       
                                </div>
                                 </div>
                                <?php
                      }
                  }
                  echo "<a href=''>See more..</a>";
                  }
                  else
                  {
                      echo "<p>Not Found</p>";
                  }
                  ?>
                     
           </div>
      </div>
      
          
      
      
  </body>
</html>
