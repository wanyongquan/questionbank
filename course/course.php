<?php
    include('../session.php');
    error_reporting(0);
    session_start();
    if (!isset($_SESSION['username'])){
        $_GLOBALS['message'] = 'Session Timeout. Click here to <a href=\"..\login.php\">Log in</a>';
    
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
    </head>
    <?php 
    /****************/
    if (isset($_GLOBALs['message'])){
        echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
    }
    ?>
<div id="container">

    <div class="nav">
        <form name="frmcourse" action="course.php" method="post">
            <ul id="menu">
                    <?php if (isset($_SESSION['username'])){?>
                    
                    <?php include '../include/menus.php';?>
                    <?php }?>
                </ul>
        </form>

    </div>
    <div id="page-course">
    <div class="no-overflow">
        <table class="admintable generaltable" id="courses">
            <thead>
                <tr>
                    <th class="table-header c0 centeralign" style=""
                        scope="col"><a
                        href="user.php?sort=coursename&amp;dir=ASC">Course Name</a></th>
                    
                    <th class="table-header c5" style="" scope="col">Action</th>
                    <th class="table-header c6 lastcol" style="" scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="lastrow">
                    <td class="centeralign cell c0" style=""><a
                        href="../user/view.php?id=2&amp;course=1">linux Core</a></td>
                    
                    <td class="cell c5" style=""><a title="Edit"
                        href="http://localhost/user/editadvanced.php?id=2&amp;course=1"><img
                            src="<?php echo $CFG->wwwroot.'/images/gear.png'?>"
                            alt="edit" class="iconsmall" /></a></td>
                    <td class="cell c6 lastcol" style=""></td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
</div>
</html>