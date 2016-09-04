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
<html>
    <head>
        <title>课程管理</title>
        <meta http-equiv="Content-Type" content="text/html;charset=GB2312"/>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
    </head>
    <?php 
    /****************/
    if (isset($_GLOBALs['message'])){
        echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
    }
    ?>
<div id="container">
    <div class="header">
            <?php require('../include/header.php')?>
        </div>
    <div class="nav">
        <form name="frmcourse" action="course.php" method="post">
            <ul id="menu">
                    <?php if (isset($_SESSION['username'])){?>
                    <li><input type="submit" value="注销" name="logout"
                    class="subbtn" /></li>
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
                        href="user.php?sort=coursename&amp;dir=ASC">课程名称</a></th>
                    
                    <th class="table-header c5" style="" scope="col">编辑</th>
                    <th class="table-header c6 lastcol" style="" scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="lastrow">
                    <td class="centeralign cell c0" style=""><a
                        href="../user/view.php?id=2&amp;course=1">linux 系统</a></td>
                    
                    <td class="cell c5" style=""><a title="编辑"
                        href="http://localhost/user/editadvanced.php?id=2&amp;course=1"><img
                            src="<?php echo $CFG->wwwroot.'/images/gear.png'?>"
                            alt="编辑" class="iconsmall" /></a></td>
                    <td class="cell c6 lastcol" style=""></td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
</div>
</html>