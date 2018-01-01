<?php
include ('../session.php');
error_reporting ( 0 );

require_once '../config.php';

if (! isset ( $_SESSION ['username'] )) {
    $_GLOBALS ['message'] = 'Session Timeout. Click here to <a href=\"' . $CFG->wwwroot . '\login.php\">Log in</a>';

} else if (isset ( $_REQUEST ['logout'] )) {
    unset ( $_SESSION ['username'] );
    $_GLOBALs ['message'] = "You are logged out.";
    header ( 'Location:' . $CFG->wwwroot . '/login.php' );
}
$courseid = $_REQUEST['courseid'];
?>
<!DOCTYPE html>
<html>
<head>
  <?php 
      require '../include/header.php';
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
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <i class="ace-icon fa fa-home home-icon"></i> <a href="#">首页</a>
        </li>
        <li>
          <a href="#">课程管理</a>
        </li>
        <li class="active">课程</li>
      </ul>
    </div>
    <script type="text/javascript">
            try{ace.settings.loadState('main-container')}catch(e){}
        </script>
        <div id="sidebar" class="sidebar responsive ace-save-state">
            <script type="text/javascript">
            try{ace.settings.loadState('sidebar')}catch(e){}
            </script>
            <ul class="nav nav-list">
                <li class="">
                    <a href="<?php echo $qb_url_root?>/index2.php"> <i class="menu-icon fa fa-tachometer"></i> <span class="menu-text">仪表板</span>
                    </a> <b class="arrow"></b>
                </li>
                <?php if ($user->isLoggedIn() ){ //if logged in?>
                <li class="active open">
                    <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-right"></i><span class="menu-text">我的课程</span><b class="arrow fa fa-angle-down"></b></a>
                    <b class="arrow"></b> 
                    <!-- todo: course list -->
                    <ul class="submenu">
                    <?php $allCourses = getAllCourses ();
                          foreach ( $allCourses as $course ) {?>
                          <li class="<?php if ($course['course_id'] == $courseid){echo'active';}?>">
                            <a href="<?php echo $qb_url_root.'/question/question.php?courseid='.$course['course_id']?>"><i class="menu-icon fa fa-caret-right"></i><?php echo $course['course_name']?></a>
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
                            <a href="<?php echo $qb_url_root?>/course/course.php"> <i class="menu-icon fa fa-caret-right"></i> 课程 
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
                <li class="">
                    <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-list"></i>
                            <span class="menu-text">课程管理</span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="">
                                <a href="<?=$qb_url_root?>/subject/subject.php?courseid=<?=$courseid ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    知识点
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="">
                                <a href="<?= $qb_url_root?>/question/question.php?courseid=<?=$courseid ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    题库
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="">
                                <a href="<?=$qb_url_root?>/rule/view.php?courseid=<?=$courseid ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    组卷规则
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="">
                                <a href="<?=$qb_url_root?>/question/zujuan.php?courseid=<?=$courseid ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    手动组卷
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
                <div class="page-content">
                    <div class="page-header">
                    <h1>课程
                        <small><i class="ace-icon fa fa-angle-double-right"></i>Overview</small>
                    </h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                          <div class="row">
                            <div class="col-lg-12">
                              <a href="<?= $qb_url_root?>/question/question.php?courseid=<?=$courseid ?>"> <span class="btn btn-purple no-border"> <i class="ace-icon fa fa-envelope bigger-130"></i> <span class="bigger-110">录入试题</span>
                              </span>
                              </a> 
                              <a href="<?= $qb_url_root?>/question/zujuan.php?courseid=<?=$courseid ?>"> <span class="btn btn-purple no-border"> <i class="ace-icon fa fa-envelope bigger-130"></i> <span class="bigger-110">手动组卷</span>
                              </span>
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="clearfix">
                                <div class="pull-right tableTools-container">
                                  
                                </div>
                            </div>
                            <div class="row">    
                                <div class="col-lg-3 col-md-6">
                                  <div class="panel panel-primary">
                                    <div class="panel-heading">
                                      <div class="row">
                                        <div class="col-xs-3">
                                          <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                          <div class="huge">12</div>
                                          <div>Chapters</div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- /.panel-heading -->
                                    <a href="<?=$qb_url_root?>/subject/subject.php?courseid=<?=$courseid ?>">
                                      <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                      </div>
                                      <!-- /.panel-footer> -->
                                    </a>
                                  </div>
                                  <!-- /.panel-->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                  <div class="panel panel-primary">
                                    <div class="panel-heading">
                                      <div class="row">
                                        <div class="col-xs-3">
                                          <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                          <div class="huge">80</div>
                                          <div>Questions</div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- /.panel-heading -->
                                    <a href="<?= $qb_url_root?>/question/question.php?courseid=<?=$courseid ?>">
                                      <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                      </div>
                                      <!-- /.panel-footer> -->
                                    </a>
                                  </div>
                                  <!-- /.panel-->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                  <div class="panel panel-primary">
                                    <div class="panel-heading">
                                      <div class="row">
                                        <div class="col-xs-3">
                                          <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                          <div class="huge">2</div>
                                          <div>Rules</div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- /.panel-heading -->
                                    <a href="<?=$qb_url_root?>/rule/view.php?courseid=<?= $courseid?>">
                                      <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                      </div>
                                      <!-- /.panel-footer> -->
                                    </a>
                                  </div>
                                  <!-- /.panel-->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                  <div class="panel panel-primary">
                                    <div class="panel-heading">
                                      <div class="row">
                                        <div class="col-xs-3">
                                          <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                          <div class="huge">4</div>
                                          <div>Papers</div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- /.panel-heading -->
                                    <a href="#">
                                      <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                      </div>
                                      <!-- /.panel-footer> -->
                                    </a>
                                  </div>
                                  <!-- /.panel-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <?php 
      require '../include/scripts.php';
      ?>
    <script src="question.js" type="text/javascript"> </script>
    
    </body>
</html>

  