<?php
   include('session.php');
   error_reporting(0);
   session_start();
   if (!isset($_SESSION['username'])){
   		$_GLOBALS['message'] = 'Session Timeout. Click here to <a href=\"login.php\">Log in</a>';

   }else if (isset($_REQUEST['logout'])) {
   		unset($_SESSION['username']);
   		$_GLOBALs['message'] = "You are logged out.";
   		header('Location:login.php');
   }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
     <!-- the above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>Question Bank </title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo $CFG->wwwroot.'/bootstrap/css/bootstrap.min.css'?>" rel="stylesheet">

<!--       <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/> -->
   </head>
   <body>
      <?php
      	/****************/
      if (isset($_GLOBALs['message'])){
        echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
      }
      ?>
      <div id="container">
        <div class="nav">
            <form name="frmwelcome" action="welcome.php" method="post">
                <?php include '/include/menus.php';?>
                
                
            </form>
        </div>
      </div>
       <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
   </body>
</html>