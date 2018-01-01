<?php

    include 'config.php';
error_reporting ( 0 );

if (! isset ( $_SESSION ['username'] )) {
    $_GLOBALS ['message'] = 'Session Timeout. Click here to <a href=\"login.php\">Log in</a>';

} else if (isset ( $_REQUEST ['logout'] )) {
    unset ( $_SESSION ['username'] );
    $_GLOBALs ['message'] = "You are logged out.";
    header ( 'Location:' . $CFG->wwwroot . '/login.php' );
}

?>
<!DOCTYPE html>
<html>
<head>
  <?php 
      require 'include/header.php';
  ?>
</head>
<body class="no-skin">
    <div id="navbar" class="navbar navbar-default ace-save-state">
        <div class="navbar-container ace-save-state" id="navbar-container">
            <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
            </button>
            <div class="navbar-header pull-left">
                <a href="<?php echo $qb_url_root?>/index2.php" class="navbar-brand"> <small><i class="fa fa-leaf"></i>燕老师题库</small>
                </a>
           </div>
<!--             <div class="navbar-buttons navbar-header pull-left" role="navigation">
                <ul class="nav ace-nav">
                    <li class="dropdown-modal">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown"> Administration </a>
                    </li>
                </ul>
            </div> -->
            <div class="navbar-buttons navbar-header pull-right" role="navigation">
                <ul class="nav ace-nav">
                    <li class="light-blue dropdown-modal">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle"> <span class="user-info"> <small>Welcome,</small>管理员
                        </span> <i class="ace-icon fa fa-caret-down"></i>
                        </a>
                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <?php if ($user->isLoggedIn() ){ //if logged in?>
                        <li>
                                <a href="#"> <i class="ace-icon fa fa-cog"></i> Settings
                                </a>
                            </li>
                            <li>
                                <a href="profile.html"> <i class="ace-icon fa fa-user"></i> Profile
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#"> <i class="ace-icon fa fa-power-off"></i> Logout
                                </a>
                            </li>
                        <?php } else { // no one is logged in, display default items?>
                        <li>
                                <a href="#"> <i class="ace-icon fa fa-power-on"></i> LogIn
                                </a>
                            </li>
                         <?php } ?>
                    </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.navbar-container -->
    </div>
    <!-- /.navbar -->
    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try{ace.settings.loadState('main-container')}catch(e){}
        </script>
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <i class="ace-icon fa fa-home home-icon"></i> <a href="#">首页</a>
        </li>
        <li class="active">仪表板</li>
      </ul>
    </div>
        <div id="sidebar" class="sidebar responsive ace-save-state">
            <script type="text/javascript">
            try{ace.settings.loadState('sidebar')}catch(e){}
            </script>
            <ul class="nav nav-list">
                <li class="active ">
                    <a href="<?php echo $qb_url_root?>/index2.php"> <i class="menu-icon fa fa-tachometer"></i> <span class="menu-text">仪表板</span>
                    </a> <b class="arrow"></b>
                </li>
                <?php if ($user->isLoggedIn() ){ //if logged in?>
                <li class="">
                    <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-right"></i><span class="menu-text">我的课程</span><b class="arrow fa fa-angle-down"></b></a>
                    <b class="arrow"></b> 
                    <!-- todo: course list -->
                    <ul class="submenu">
                    <?php $allCourses = getAllCourses ();
                          foreach ( $allCourses as $course ) {?>
                          <li class="">
                            <a href="<?php echo $qb_url_root.'/question/view.php?courseid='.$course['course_id']?>"><i class="menu-icon fa fa-caret-right"></i><?php echo $course['course_name']?></a>
                            <b class="arrow"></b>
                          </li>
                    <?php }?>
                    </ul>
                </li>
                <?php }?>
                <li class="">
                    <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-desktop"></i> <span class="menu-text">系统管理</span> <b class="arrow fa fa-angle-down"></b>
                    </a> <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="<?=$qb_url_root?>/course/course.php"> <i class="menu-icon fa fa-caret-right"></i> 课程 
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="">
                            <a href="#"> <i class="menu-icon fa fa-caret-right"></i> 用户
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- /.nav-list -->
            <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
            </div>
        </div>
        <!-- /.sidebar -->
        <div class="main-content">
            <div class="main-content-inner">
             </div>
        </div>
    </div>
     <?php 
      require 'include/scripts.php';
      ?>
    
    </body>
</html>