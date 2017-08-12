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
    </script>
  </head>
  <body>
      <?php include './view/title.php';?>
      <?php
      
      $TO  = mysql_escape_string($_REQUEST["to"]);
      if($TO == $_SESSION["UID"])
      {
          echo "<center>You Can't Send Message to your self.!</center>";
          die();
      }
      $RowTo= mysql_query("select * from `members` where id=$TO ");
      if(mysql_num_rows($RowTo)==0)
      {
          echo "<center>You Can't Send Message to this user.!</center>";
          die();
      }
      $ToData = mysql_fetch_array($RowTo);
      ?>
      <div class="container container-fluid">
          
           <div class="panel panel-default">
               <div class='panel-heading'>Send message to <?php echo ucfirst($ToData['name']); ?></div>
           </div>
                  
              <div class="panel-body" style="height:270px;overflow-y: scroll" id='chat'>
              
                    <?php
                    $row = mysql_query("select * from `msg` where `from`='$TO' and `to`='$_SESSION[UID]' or `from`='$_SESSION[UID]' and `to`='$TO'");
                    while($arry= mysql_fetch_array($row))
                    {
                        if($arry['to']==$_SESSION["UID"])
                        {
                            ?>    
                  <me class='pull-left' style='margin-top: 5px;padding: 3px;border-radius:2px;width: 100%;padding:6px 7px 8px 9px'>
                      
                      <msg class="pull-left"  style="word-break: break-all">
                          <a class="pull-left">
                              <small style="font-size: 10px"><?php  $date = date_create($arry['dt']); echo date_format($date, 'H:i a'); ?></small>
                          </a>
                          <br/>
                          <?php echo $arry['message']; ?>
                      </msg>

                  </me><br/>
            <?php
            
        }
        else
        {
            ?>
                  <you class='pull-right' style='margin-top: 5px;padding: 3px;border-radius:2px;width: 100%;padding:6px 7px 8px 9px'>
                      
                      <msg class="pull-right" style="word-break: break-all">
                          <a class="pull-right">
                              <small style="font-size: 10px"><?php  $date = date_create($arry['dt']); echo date_format($date, 'H:i a'); ?></small>
                          </a>
                          <br/>
                          <?php echo $arry['message']; ?>
                      </msg>

                  </you><br/>  
                            <?php
                        }
                    }
                    ?>
               </div>
          
              <br/>
              
              <div class="panel-footer" >
                  Send Message.
                  <textarea class="form-control" id="txtChat"></textarea>
                  <button class='btn btn-success' id='sendMsg'>Send</button>
                   <script>
                      $("#sendMsg").click(function()
                      {
                          $("#sendMsg").attr("disabled", true);
                          var msg1 = $("#txtChat").val();
                          if(msg1!="" || msg1!=" " || msg1!=null)
                          {
                               $.post("Script/send.php",{to:"<?php echo $TO; ?>",msg:msg1},function(data)
                            {
                                 location.reload();
                            });
                            
                          }
                          else
                          {
                            alert("Enter Message.!"); 
                          }
                      });
                  </script>
              </div>
              <br/>
          
      </div>
      
   
  </body>
</html>
<?php
if(isset($_REQUEST["btn_pro"]))
{
   
}
?>