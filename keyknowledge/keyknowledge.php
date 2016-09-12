<?php
    include_once ('../config.php');

    error_reporting(1);
    session_start();
    if (!isset($_SESSION['username'])){
        $_GLOBALS['message'] = 'Session Timeout. Click here to <a href=\"'.$CFG->wwwroot.'\login.php\">Log in</a>';

    }else if (isset($_REQUEST['logout'])) {
        unset($_SESSION['username']);
        $_GLOBALs['message'] = "You are logged out.";
        header('Location:'.$CFG->wwwroot.'/login.php');
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
   <body>
    <?php
    /****************/
    if (isset($_GLOBALs['message'])){
        echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
    }
    ?>
        <div class="container">
            <div class="nav">
            <form name="frmknowledge"  method="post">

                        <?php if (isset($_SESSION['username'])){?>

                        <?php include '../include/menus.php';?>
                        <?php }?>

            </form>
            <div class="page-knowledge">
                <h2>Key Knowledge</h2>
                <div><button class="btn btn-success" data-toggle="modal" data-target="#add_keyknowledge_modal" data-backdrop="false">新增知识点</button></div>
            </div>
            <div class="knowledge_content">
                <!-- knowledge content table starts here -->
            </div>
        </div>
        </div>
    </body>
</html>