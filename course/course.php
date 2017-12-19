<?php
    include('../session.php');
    error_reporting(0);
    
    require_once '../config.php';
    
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
    <title>燕子题库</title>
    <!-- Bootstrap core CSS -->
    <link href="../lib/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../lib/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- SB Admin 2 CSS -->
    <link href="../lib/sb-admin-2/css/sb-admin-2.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="../lib/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom css -->
    <link href="../css/footer.css" rel="stylesheet">
    <link href="../css/all.css" rel="stylesheet">
 </head>
 <body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default nav-static-top" role="navigation" style="margin-bottom:0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index2.php">燕子题库</a>
            </div>
            <!-- ./navbar-header -->
            <ul class="nav navbar-top-links navbar-left">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">基本数据管理
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="">课程</a>
                        </li>
                        <li>
                            <a href="">知识点</a>
                        </li>
                        <li>
                            <a href="">组卷规则</a>
                        </li>
                    </ul>
                    
                </li>
                <li>
                    <a >题库管理</a>
                </li>
            </ul>
            <!-- ./navar-left -->
            <ul class="nav navbar-top-links navbar-right">
                 <?php if ($user->isLoggedIn() ){ //if logged in?>
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i><?=$user->username() ?></a>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-cog fa-fw"></i><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i>账号设置</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-gear fa-fw"></i>个人主页</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo $CFG->wwwroot?>/logout.php"><i class="fa fa-sign-out fa-fw"></i>退出</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
           <?php } else { // no one is logged in, display default items?>
                <li>
                    <a href="<?=$CFG->wwwroot?>/login.php" class=""><i class="fa fa-sign-in"></i>登录</a>
                </li>
                <!-- /.dropdown -->
           <?php } ?>
            </ul>
            <!-- /.navbar-right-->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index2.php"><i class="fa fa-dashboard fa-fw"></i>仪表盘</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i>基本数据<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=$qb_url_root.'/course/course.php' ?>">课程</a>
                                </li>
                                <li>
                                    <a href="">知识点</a>
                                </li>
                                <li>
                                    <a href="">组卷规则</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href=""><i class="fa fa-wrench fa-fw"></i>题库<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="">课程1</a></li>
                                <li><a href="">课程2</a></li>
                                <li><a href="">课程3</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- ./sidebar -->
        </nav>
        <!-- /nagivation -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">课程管理</h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">课程
                            <div class="pull-right">
                                <button class="btn btn-primary btn-xs"  data-toggle="modal" data-target="#add_new_course_modal"  data-backdrop="false">新增课程</button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="coursescontent">
                                        <!-- getCourses() table starts here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
        </div>
        <!-- /.page-wrapper -->
    </div>
    <!-- /.wrapper -->

    <!--  Modal dialog for add new course  -->
    <div id="add_new_course_modal" class="modal fade" role="dialog">
        <div class="modal-dialog" >
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
                            <input   type="text" id="coursename"
                                placeholder="Course Name"
                                class="form-control" required data-error="Please enter course name"/>
                            <div class="help-block with-errors"></div>  </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="col-xs-3 control-label">描述</label>
                            <div class="col-xs-6"> <input
                                type="text" id="description"
                                placeholder="Description"
                                class="form-control" /></div>
                        </div>
                      </form>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary" id="btnAddCourse">保存</button>
                    </div> <!-- End of modal footer -->
            </div> <!-- End of modal content -->
        </div> <!-- End of modal dialog -->
    </div> <!-- End of Modal -->
    <!--  end of modal new course-->

    <!-- Modal dialog for edit course -->
    <div id="edit_course_modal" class="modal fade"  role="dialog" >
        <div class="modal-dialog" >
            <!-- Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" >编辑 课程</h4>
                    <input type="hidden" id="hidden_course_id">
                </div>
                <div class="modal-body">
                  <form id="edit_course_form" class="form-horizontal" role="form" method="post" data-toggle="validator">
                    <div class="form-group">
                        <label for="edit-coursename" class="col-xs-3">课程名称</label>
                        <div class="col-xs-6">
                        <input type="text" id="edit_coursename" placeholder="Course Name" class="form-control" required/>
                        <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit-coursedescription" class="col-xs-3">描述</label>
                        <div class="col-xs-6">
                        <input type="text" id="edit_coursedescription" placeholder = "Description" class="form-control"/>
                        </div>
                    </div>
                    </form>
                </div> <!-- end of moal body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="btnEditCourse">保存</button>
                </div><!--  end of modal-footer -->
            </div><!--  end of modal content -->
        </div><!--  end of modal dialog -->
    </div><!--  end of modal  -->
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
                      <p> 你确定要删除本课程吗?</p>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal">取消</button>
                            <a class="btn btn-danger btn-ok" onclick="deleteCourse(this)">删除</a>
                    </div><!--  end of modal-footer -->
            </div><!--  end of modal-content -->
        </div><!--  end of modal-dialog -->
    </div><!--  end of modal -->
    <!--  end of modal delete course-->



    <!-- jQuery -->
    <script src="<?=$qb_url_root?>/lib/vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?=$qb_url_root?>/lib/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=$qb_url_root?>/lib/vendor/metisMenu/metisMenu.min.js"></script>
    <!-- Sb Admin 2 Theme JavaScript -->
    <script src="<?=$qb_url_root?>/lib/sb-admin-2/js/sb-admin-2.js"></script>
    <!-- Form validation JavaScript -->
    <script src="<?=$qb_url_root?>/script/form-validator.min.js" type="text/javascript"></script>
    
    <script src="course.js"  type="text/javascript"> </script>
    </body>
</html>