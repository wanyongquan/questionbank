<?php
include_once ('../config.php');

error_reporting ( 1 );

?>
<!DOCTYPE html>
<html>
<head>
 <?php 
      require '../include/header.php';
  ?>
</head>
<body class="no-skin">
    <?php 
        require_once '../include/navigation.php';
    ?>
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
                <li class="active open">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-list"></i><span class="menu-text">课程管理</span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a> 
                    <b class="arrow"></b>
                    <ul class="submenu">
                            <li class="active">
                                <a href="<?=$qb_url_root?>/subject/subject.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    知识点
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="">
                                <a href="<?php echo $qb_url_root.'/question/question.php?courseid=5'?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    题库
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="">
                                <a href="<?=$qb_url_root?>/rule/view.php">
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
        <!--  /.sidebar -->
        <div class="main-content">
            <div class="main-content-inner">
                <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a href="#">首页</a>
                        </li>
                        <li>
                            <a href="#">课程管理</a>
                        </li>
                        <li>
                            <a href="#">Course_name</a>
                        </li>
                        <li class="active">subject</li>
                    </ul>
                </div>
                <!-- /.breadcrumbs -->
                <div class="page-content">
                    <div class="page-header">
                        <h1>subject<small><i class="ace-icon fa fa-angle-double-right"></i>CRUD</small></h1>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="clearfix">
                                <div class="pull-right tableTools-container">
                                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add_subject_modal" data-backdrop="false">新增知识点</button>
                                </div>
                            </div>
                            <div>
                                <table id="simple-table" class="table table-striped table-hover table-bordered">
                                    <thead>
                                    <tr><th>章节</th><th></th></tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $subjects = getSubjects();
                                            if (isset($subjects)){
                                                foreach ($subjects as $subject){
                                                    echo '<tr>';
                                                    echo '<td>'.$subject['subject_name'].'</td>';
                                                    echo '<td><div class="hidden-sm hidden-xs action-buttons">';
                                                    echo ' <a title="编辑" onclick="getSubjectDetails(' . $subject ['subject_id'] . ')" data-toggle="modal" data-target="#edit_subject_modal" data-backdrop="false" >
                                                            <span class="green"><i class="ace-icon fa fa-pencil bigger-120"></i></span></a>';
                                                    echo '<a title="删除" class="delete_product" data-id="' . $subject ['subject_id'] . '" data-toggle="modal" data-target="#delete_subject_modal" data-backdrop="false">
                                                            <span class="red"><i class="ace-icon fa fa-trash-o bigger-120"></i></span></a></div></td>';
                                                    echo '</tr>';
                                                }
                                            };
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-wrapper -->
                        </div>
                    </div>
                </div>
                <!--  /.page-content -->
            </div>
        </div>
        <!-- /.main-content" -->
    </div>
    
    <!-- Modal dialog for add new subject -->
    <div id="add_subject_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">新增 知识点</h4>
                </div>
                <div class="modal-body">
                    <form id="add_subject_form" class="form-horizontal" role="form" data-toggle="validator">
                        <div class="form-group">
                            <label for="subject_name" class="col-xs-3">知识点</label>
                            <div class="col-xs-8">
                                <input type="text" id="subject_name" placeholder="" required data-error="Please enter subject name" class="form-control" />
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qitem_course_id" class="col-xs-3">课程</label>
                            <div class="col-sm-8">
                                <select id="qitem_course_id" name="qitem_course_id" class="form-control ">
                                    <option value="">请选择课程</option>
                                        <?php
                                        $courses = getCourses ();
                                        if ($courses->num_rows > 0) {
                                            foreach ( $courses as $course ) {
                                                $courseselected = ($course_id == $course ['course_id']) ? "selected" : "";
                                                echo '<option value="' . $course ['course_id'] . '" ' . $courseselected . ' >' . $course ['course_name'] . '</option>';
                                            }
                                        }
                                        ?>    
                                     </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="btnAddSubject">保存</button>
                </div>
                <!-- End of modal footer -->
            </div>
            <!-- End of modal content -->
        </div>
        <!-- End of modal dialog -->
    </div>
    <!-- End of Modal  -->
    <!-- Modal dialog for edit subject -->
    <div id="edit_subject_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">编辑 知识点</h4>
                    <input type="hidden" id="hidden_subject_id">
                </div>
                <div class="modal-body">
                    <form id="edit_subject_form" class="form-horizontal" role="form" method="post" data-toggle="validator">
                        <div class="form-group">
                            <label for="edit_subject_name" class="col-xs-3">知识点名称</label>
                            <div class="col-xs-8">
                                <input type="text" id="edit_subject_name" placeholder="" required data-error="Please enter subject name" class="form-control" />
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="btnEditSubject">保存</button>
                </div>
                <!-- End of modal footer -->
            </div>
            <!-- End of modal content -->
        </div>
        <!-- End of modal dialog -->
    </div>
    <!-- End of Modal  -->
    <!--  Modal dialog for delete subject  -->
    <div id="delete_subject_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">删除知识点</h4>
                    <input type="hidden" id="hidden_edit_subject_id">
                </div>
                <div class="modal-body">
                    <p>确定要删除该知识点吗?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <a class="btn btn-danger btn-ok" onclick="deleteSubject()">删除</a>
                </div>
                <!--  end of modal-footer -->
            </div>
            <!--  end of modal-content -->
        </div>
        <!--  end of modal-dialog -->
    </div>
    <!--  end of modal -->
    <!--  end of modal delete subject-->
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
    <script src="subject.js" type="text/javascript"></script>
</body>
</html>