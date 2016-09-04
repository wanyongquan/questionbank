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
<html>
   <head>
      <title>Question Bank </title>
      <meta http-equiv="Content-Type" content="text/html;charset=GB2312"/>
      <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
   </head>
   <body>
      <?php
      	/****************/
      if (isset($_GLOBALs['message'])){
        echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
      }
      ?>
      <div id="container">
        <div class="header">
            <?php require'/include/header.php';?>
        </div>
        <div class="nav">
            <form name="frmwelcome" action="welcome.php" method="post">
                <ul id="menu">
                    <?php if (isset($_SESSION['username'])){?>
                    <li><input type="submit" value="注销" name="logout" class="subbtn"/></li>
                    <?php include '/include/menus.php';?>
                    <?php }?>
                </ul>
            </form>
        </div>
      </div>
   </body>

</html>