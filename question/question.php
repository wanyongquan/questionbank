<?php
include_once '../config.php';

include_once '../session.php';
include_once '../lib/datelib.php';
include_once 'lib.php';

error_reporting ( 1 );
    $courseId = $_REQUEST['courseid'];
    $questions = getQuestionsByCourseId($courseId);
    
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
                            <li class="">
                                <a href="<?=$qb_url_root?>/subject/subject.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    知识点
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="active">
                                <a href="<?php echo $qb_url_root.'/question/question.php?courseid=5'?>">
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
                            <a href="#">课程管理</a>
                        </li>
                        <li>
                            <a href="#">题库</a>
                        </li>
                        <li class="active">course_name</li>
                    </ul>
                </div>
                <!-- /.breadcrumbs -->
                <div class="page-content">
                    <div class="page-header">
                        <h1>题库<small><i class="ace-icon fa fa-angle-double-right"></i>course_name</small></h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xs-12">         
                            <div class="clearfix">
                                <div class="pull-right tableTools-container">
                                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#choose_questiontype_modal" data-backdrop="false">新增试题</button>
                                </div>
                            </div>
                            <div>
                        <table id="simple-table" class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr><th>名称</th><th>题型</th><th>难度</th><th>知识点</th><th>分数</th><th>创建人</th><th>创建日期</th><th>操作</th></thead>
                                    <tbody>                                      
                                <?php 
                                if (isset($questions)){
                                    foreach ($questions as $question){
                                        echo '<tr>';
                                        echo '<td>'.$question['question_name'].'</td>';
                                        echo '<td>'.$question['qtype'].'</td>';
                                        echo '<td>'.$question['difficultyLevel'].'</td>';
                                        echo '<td>'.$question['subject_name'].'</td>';
                                        echo '<td>'.$question['point'].'</td>';
                                        echo '<td>'.$question['createdBy'].'</td>';
                                        echo '<td>'.$question['createdDate'].'</td>';
                                        echo '<td><a title="编辑" href="'.$question['qtype'].'/edit.php?courseid='.$courseId.'&id='.$question['question_id'].'"><span class="green"><i class="ace-icon fa fa-pencil bigger-120"></i></span></a>&nbsp;&nbsp;';
                                        echo '<a title="删除" data-id="'.$question['question_id'].'" data-toggle="modal" data-target="#delete_question_modal"  data-backdrop="false"><span class="red"><i class="ace-icon fa fa-trash-o bigger-120"></i></span></a></td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>
                                    </tbody>
                                </table>
                                </div>
                                <!-- /.table-wrapper -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.main-container -->
    
    <!--  Modal dialog for add question -->
    <div id="choose_questiontype_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">选择题型</h4>
                </div>
                <div class="modal-body">
                    <form id="choose_questiontype_form" method="post" class="form-horizontal" role="form" data-toggle="validator">
                        <input type="hidden" name="courseid" value="<?php echo $courseId?>">
                        <div class="row">
                            <div class="col-sm-5 col-md-5 navbar-default ">
                                <div class="sidebar-nav">
                                    <div class="navbar  form-group " role="navigation">
                                        <div id="typeoptions" class="navbar-collapse collapse sidebar-navbar-collapse">
                                            <ul class="nav navbar-nav">
                                                <li class="active">
                                                    <label>
                                                        <input id="option1" type="radio" name="questiontype" value="multichoice" required data-error="please choose at least one question type"></input> <span class="typename">选择题</span>
                                                    </label>
                                                </li>
                                                <li class="">
                                                    <label>
                                                        <input id="option2" type="radio" name="questiontype" value="truefalse" required> <span class="typename">判断题</span>
                                                    </label>
                                                </li>
                                                <li class="">
                                                    <label>
                                                        <input id="option3" type="radio" name="questiontype" value="fillblank" required> <span class="typename">填空题</span>
                                                    </label>
                                                </li>
                                                <li class="">
                                                    <label>
                                                        <input id="option4" type="radio" name="questiontype" value="shortanswer" required> <span class="typename">简答题</span>
                                                    </label>
                                                </li>
                                                <li class="">
                                                    <label>
                                                        <input id="option5" type="radio" name="questiontype" value="genaral" required> <span class="typename">综合题</span>
                                                    </label>
                                                </li>
                                            </ul>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7  col-md-7 main">
                                <div class="summarycontent option1">从预先定义的选项中选择一个或多个做为答案。</div>
                                <div class="summarycontent option2">判断题目的正确或错误</div>
                                <div class="summarycontent option3">在空白处填入正确答案</div>
                                <div class="summarycontent option4">根据题目回答</div>
                                <div class="summarycontent option5">综合题目</div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btnAddQuestion">添加</button>
                </div>
                <!-- End of modal footer -->
            </div>
            <!-- End of modal content -->
        </div>
        <!-- End of modal dialog -->
    </div>
    <!-- End of Modal  -->
    <!--  Modal dialog for delete   -->
    <div id="delete_question_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Question</h4>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete this question?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <a class="btn btn-danger btn-ok" onclick="deleteQuestion(this)">Delete</a>
                </div>
                <!--  end of modal-footer -->
            </div>
            <!--  end of modal-content -->
        </div>
        <!--  end of modal-dialog -->
    </div>
    <!--  end of modal -->
    <!--  end of modal delete -->
    <?php 
      require '../include/scripts.php';
      ?>
    <script src="question.js" type="text/javascript"></script>
</body>
</html>