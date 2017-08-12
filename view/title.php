
<?php
if(isset($_SESSION["user"]))
{
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        
      </button>
         <?php 
                $RowForTotalMsg=mysql_query("select count(*) as `totmsg` from `msg` where `to`='$_SESSION[UID]' and `status`='send' ");
                $TotalMsg=mysql_fetch_array($RowForTotalMsg);
          ?>
        <a href="inbox.php" style="color: white;text-decoration: none" class="navbar-toggle collapsed" aria-expanded="false">
            Inbox<span class="badge"><?php echo $TotalMsg["totmsg"] ?></span>
        </a>
      <a class="navbar-brand" href="index.php">Ashu Sharma</a>
      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">        
        <li><a href="aboutme.php">About Me</a></li>
        <li><a href="project.php"><small>free </small>Project</a></li>
      </ul>
        <script>
            function chkSr()
            {
                    var a = $("#srch").val();
                    if(a=="" || a==null || a==" ")
                    {
                        alert("Enter any details to sreach.");
                        return false;
                    }
                    return true;
            }
        </script>
        <form class="navbar-form navbar-left" role="search" action="search.php" onsubmit="return chkSr()">
          <div class="input-group">
              <input type="text" class="form-control" name="searchIteam" placeholder="Search for..." id="srch">
              <span class="input-group-btn">
                  <input type="submit" class="btn btn-default" type="button" value="Go!" />
              </span>
            </div>  
      </form>
      <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" > Notification <span class="caret"></span></a>
          <ul class="dropdown-menu">
              
                      <?php
                      $row = mysql_query("select * from `friends` where `receiver`=$_SESSION[UID] and `status`='panding' ");
                      $totRowReq = mysql_num_rows($row);
                      if($totRowReq==0)
                      {
                          echo "<center style='padding:10px'><span class='glyphicon glyphicon-envelope'></span> Notification Empty</center>";
                      }
                      while($aq = mysql_fetch_array($row))
                      {
                                $Q = $aq['sender'];
                                $q = mysql_query("select * from `members` where id =$Q ");
                                $qarr  = mysql_fetch_array($q);
                          ?>
              <li class="gl">
                                    <div>
                                        <name><a style="text-decoration: none" href="user.php?user=<?php echo $qarr['id']; ?>"><?php echo ucfirst($qarr['name']); ?></a></name><br/>
                                        <x><a href="Script/becomefrnd.php?OK=<?php echo $aq['id']; ?>" class="" style="color: greenyellow;text-decoration: none">Add</a>&nbsp;<a href="Script/becomefrnd.php?NOT=<?php echo $aq['id']; ?>" style="color: red" >Delete</a></x>        
                                    </div>
                                </li>
                                
                          <?php
                      }
                      ?>
          </ul>
        </li>
          <li class="hidden-xs"><a href="inbox.php">Inbox <span class="badge"><?php echo $TotalMsg["totmsg"] ?></span></a></li>
          
        <li class="dropdown">
            
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
          <ul class="dropdown-menu">
                
              <li class=''><a href="account.php">Account</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php
}
 else {
?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a href="project.php" style="color: white;text-decoration: none" class="navbar-toggle collapsed" aria-expanded="false"><small>free</small> Project</a>
      <a class="navbar-brand" href="index.php">Ashu Sharma</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">        
        <li><a href="aboutme.php">About Me</a></li>
        <li><a href="project.php"><small>free </small>Project</a></li>
      </ul>
       <!--<script>
            function chkSr()
            {
                    var a = $("#srch").val();
                    if(a=="" || a==null || a==" ")
                    {
                        alert("Enter any details to sreach.");
                        return false;
                    }
                    return true;
            }
        </script>
        <form class="navbar-form navbar-left" role="search" action="search.php" onsubmit="return chkSr()">
          <div class="input-group">
              <input type="text" class="form-control" name="searchIteam" placeholder="Search for..." id="srch">
              <span class="input-group-btn">
                  <input type="submit" class="btn btn-default" type="button" value="Go!" />
              </span>
            </div>  
      </form>
      -->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>



 <?php } ?>
