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
            $("#inbox").hide();
        });
       
                
            
    </script>
  </head>
  <body>
      <?php include './view/title.php';?>
      <div class='container container-fluid'>
          <div class='col-md-3'>
              <div  id='Firends'>
              <div class="panel panel-primary" >
                  <div class='panel-heading'>Friend's Chat History </div>
                  </div>
                  
              <div class="panel-body" style="margin-top: -30px">
                  <nav>
                  <ul class="nav navbar-nav">
                      <?php 
                      $row=mysql_query("select * from `msg` where `to`='$_SESSION[UID]' GROUP BY `from`");
                      
                      
                      $stack = array();
                      if(mysql_num_rows($row)==0)
                      {
                          echo "<center>Conversation Not Found.</center>";
                      }
                      while($ALLUser= mysql_fetch_array($row))
                      {
                           ?>
                      <script>
                      $(document).ready(function()
                      {
                          
                          
                          $("#userSelect<?php echo $ALLUser['from'] ?>").click(function()
                        {
                            $("#inbox").hide(); 
                            if( navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i)|| navigator.userAgent.match(/Windows Phone/i) )
                            {
                               $("#Firends").hide();
                            }
                            $("#inbox").html("<center style='margin-top:120px'>Loading..!</center>");
                            $("#inbox").show();
                            var c1 = $("#userSelect<?php echo $ALLUser['from']; ?>").val();   
                            $.post("Script/msg.php",{from:c1},function(data)
                            {
                                $("#inbox").html(data);
                                $("#inbox").show();
                            });
                        });
                      });
                              </script>
                          <?php
                          $Row4name=mysql_query("select * from `members` where id=$ALLUser[from] ");
                          
                          while($ALLUserName = mysql_fetch_array($Row4name))
                          {
                              $row1 = mysql_query("select count(*)as `tot1` from `msg` where `to`='$_SESSION[UID]' and `from`='$ALLUser[from]' and `status`='send' ");
                            
                               $arr1 = mysql_fetch_array($row1);
                              if($arr1['tot1']=="0")
                              {
                                 
                                ?>
                      <li id='userSelect<?php echo $ALLUser['from'] ?>' value="<?php echo $ALLUser['from'] ?>">                                    
                                    
                                    <?php 
                                    if(in_array($ALLUserName['name'], $stack))
                                    {
                                        
                                    }
                                    else
                                    {
                                        echo "<a>".ucfirst($ALLUserName['name']);
                                        ?>
                          <span class=""><small>Message's</small></span>                                        
                                        <?php
                                        array_push($stack, $ALLUserName['name']);    
                                        echo "</a>";
                                        
                                    }
                                    
                                    ?>
                                
                                    </li>
                                <?php
                                  
                              }
                              else
                              {
                              
                                ?>
                                    <li id='userSelect<?php echo $ALLUser['from'] ?>' value="<?php echo $ALLUser['from'] ?>">                                    
                                    <?php 
                                    if(in_array($ALLUserName['name'], $stack))
                                    {
                                        
                                    }
                                    else
                                    {
                                        echo "<a>".$ALLUserName['name'];
                                        ?>
                                    
                                        <span class="badge"><?php echo $arr1['tot1']; ?></span>    
                                        <?php
                                        array_push($stack, $ALLUserName['name']);    
                                        echo "</a>";
                                    }
                                    
                                    ?>
                                
                                    </li>
                                <?php
                              }
                          }
                      }
                        ?>
                                
                  </ul>
                  </nav>
              </div>
              
              </div>
          </div>
          
          <div class='col-md-7' id="inbox">
              <div class="panel panel-default">
                  <div class='panel-heading'>Inbox <span class="pull-right"><small>Show Friend's Chat</small></span></div>
                  </div>
                  
              <div class="panel-body" style="height:270px;overflow-y: scroll" >
                  
                  <center>Please Wait Loding...</center>
                  
              </div>
              <br/>
              
              <div class="panel-footer" >
                  Send Message.
                  <textarea class="form-control disabled" disabled></textarea>
                  <button class='btn btn-success' disabled>Send</button>
                             
              </div>
              <br/>
          </div>
      </div>
      
  </body>
</html>


