<?php
   include('session.php');
   error_reporting(0);
   session_start();
   if (!isset($_SESSION['username'])){
   		$_GLOBALS['message'] = 'Session Timeout. Click here to <a href=\"login.php\">Log in</a>';

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
    <title>Question Bank</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo $CFG->wwwroot.'/bootstrap/css/bootstrap.min.css'?>" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="lib/sb-admin-2/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- SB Admin 2 CSS -->
    <link href="lib/sb-admin-2/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="lib/sb-admin-2/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
   </head>
   <body>
     <div id="wrapper">
      <!-- Nav -->
      <nav class="navbar navbar-default nav-bar-static-top" role="navigation" style="margin-bottom:0">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">Question Bank</a>
        </div>
        <!-- /.navbar-header -->
        
        <ul class="nav navbar-top-links navbar-right">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="fa fa-user fa-fw"></i><i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
              <li><a href="#"><i class="fa fa-user fa-fw"></i>User Profile</a></li>
              <li><a href="#"><i class="fa fa-gear fa-fw"></i>Settings</a></li>
              <li class="divider"></li>
              <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a></li>
            </ul>
            <!-- /.dropdown-user -->
          </li>
          <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
        <div class="navbar-default sidebar" role="navigation">
          <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
              <li> <a href="index.php"><i class="fa fa-dashboard fa-fw"></i>网站首页</a>
              </li>
              <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i>课程管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                  <li>
                    <a href="">用户</a>
                  </li>
                  <li>
                    <a href="<?php echo $CFG->wwwroot.'/subject/subject.php'?>">知识点</a>
                  </li>
                  <li>
                    <a href="">组卷规则</a>
                  </li>
                  <li>
                    <a href="">题库</a>
                  </li>
                </ul>
              </li>
              <!-- /.Second Level -->
              <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i>系统管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                  <li>
                    <a href="">用户</a>
                  </li>
                  <li>
                    <a href="">角色</a>
                  </li>
                  <li>
                    <a href="<?php echo $CFG->wwwroot.'/course/course.php'?>">课程</a>
                  </li>
                </ul>
              </li>
              <!-- /.Second Level -->
            </ul>
          </div>
          <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
      </nav>
      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Welcome, </h1>
          </div>
          <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
          
        </div>
        <!-- /.row -->
      </div>
     </div>
      
       
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- jQuery -->
    <script src="lib/jquery/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!--  metisMenu Plugin JavaScript -->
    <script src="lib/sb-admin-2/vendor/metisMenu/metisMenu.min.js"></script>
    <!-- SB Admin 2 JavaScript -->
    <script src="lib/sb-admin-2/dist/js/sb-admin-2.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
   </body>
</html>