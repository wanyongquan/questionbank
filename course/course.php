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
?>
<!DOCTYPE html>
<html lang="en">
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
                <a href="<?php echo $qb_url_root?>/index2.php" class="navbar-brand"> <small><i class="fa fa-leaf"></i>燕子题库</small>
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
        <div id="sidebar" class="sidebar responsive ace-save-state">
            <script type="text/javascript">
            try{ace.settings.loadState('sidebar')}catch(e){}
            </script>
            <ul class="nav nav-list">
                <li class="">
                    <a href="<?php echo $qb_url_root?>/index2.php"> <i class="menu-icon fa fa-tachometer"></i> <span class="menu-text">Dashboard</span>
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
                            <a href="<?php echo $qb_url_root.'/question/question.php?courseid='.$course['course_id']?>"><i class="menu-icon fa fa-caret-right"></i><?php echo $course['course_name']?></a>
                            <b class="arrow"></b>
                          </li>
                    <?php }?>
                    </ul>
                </li>
                <?php }?>
                <li class="active open">
                    <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-desktop"></i> <span class="menu-text">系统管理</span> <b class="arrow fa fa-angle-down"></b>
                    </a> <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="active">
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
                                <a href="<?=$qb_url_root?>/subject/subject.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    知识点
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="">
                                <a href="http://localhost/questionbank/question/question.php?courseid=5">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    题库
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="">
                                <a href="jqgrid.html">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    组卷规则
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
                <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a href="#">首页</a>
                        </li>
                        <li>
                            <a href="#">系统管理</a>
                        </li>
                        <li class="active">课程</li>
                    </ul>
                </div>
                <!-- /.breadcrumbs -->
                <div class="page-content">
                    <div class="page-header">
                    <h1>课程
                        <small><i class="ace-icon fa fa-angle-double-right"></i>新增、编辑、删除课程</small>
                    </h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="coursescontent">    
                                <!-- getCourses() table starts here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <!--  Modal dialog for add new course  -->
    <div id="add_new_course_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">新增 课程</h4>
                </div>
                <div class="modal-body">
                    <form id="addCourseForm" class="form-horizontal" role="form" method="post" data-toggle="validator">
                        <div class="form-group">
                            <div class="controls">
                                <label for="first_name" class="col-xs-3 col-md-3 control-label">课程名称</label>
                                <div class="col-xs-6 col-md-6">
                                    <input type="text" id="coursename" placeholder="请输入课程名称" class="form-control" required data-error="Please enter course name" />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="col-xs-3 control-label">描述</label>
                            <div class="col-xs-6">
                                <input type="text" id="description" placeholder="Description" class="form-control" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary" id="btnAddCourse">保存</button>
                </div>
                <!-- End of modal footer -->
            </div>
            <!-- End of modal content -->
        </div>
        <!-- End of modal dialog -->
    </div>
    <!-- End of Modal -->
    <!--  end of modal new course-->
    <!-- Modal dialog for edit course -->
    <div id="edit_course_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">编辑 课程</h4>
                    <input type="hidden" id="hidden_course_id">
                </div>
                <div class="modal-body">
                    <form id="edit_course_form" class="form-horizontal" role="form" method="post" data-toggle="validator">
                        <div class="form-group">
                            <label for="edit-coursename" class="col-xs-3">课程名称</label>
                            <div class="col-xs-6">
                                <input type="text" id="edit_coursename" placeholder="Course Name" class="form-control" required />
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit-coursedescription" class="col-xs-3">描述</label>
                            <div class="col-xs-6">
                                <input type="text" id="edit_coursedescription" placeholder="Description" class="form-control" />
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end of moal body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="btnEditCourse">保存</button>
                </div>
                <!--  end of modal-footer -->
            </div>
            <!--  end of modal content -->
        </div>
        <!--  end of modal dialog -->
    </div>
    <!--  end of modal  -->
    <!--  End of modal dialog for edit course -->
    <!--  Modal dialog for delete course  -->
    <div id="delete_course_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">删除课程</h4>
                </div>
                <div class="modal-body">
                    <p>你确定要删除本课程吗?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <a class="btn btn-danger btn-ok" onclick="deleteCourse(this)">删除</a>
                </div>
                <!--  end of modal-footer -->
            </div>
            <!--  end of modal-content -->
        </div>
        <!--  end of modal-dialog -->
    </div>
     <?php 
      require '../include/scripts.php';
      ?>
    <script src="course.js" type="text/javascript"> </script>
    
    </body>
</html>

  