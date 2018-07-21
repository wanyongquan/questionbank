<?php

include_once '../config.php';

include_once '../session.php';
include_once '../lib/dblib.php';


$id = null;
$rule_id = null;
$rule_name = null;

if (isset ( $_REQUEST ['courseid'] )) {
    $courseid = $_REQUEST ['courseid'];
}

if (null != $id) {
    // for edit a existing rule
    // get rule details and show on page
    $query = "select * from tk_rules " . " left join tk_subjects on tk_subjects.subject_id = tk_rules.subject_id" . " left join vw_difficultylevels on vw_difficultylevels.item_value = tk_rules.difficultylevel_id" . " where tk_rules.rule_id=$id";
    $result = mysqli_query ( $DB, $query );
    if (! $result) {
        // error
    } else {
        $row = mysqli_fetch_assoc ( $result );
        $rule_id = $row ['rule_id'];
        $rule_name = $row ['rule_name'];
        $qbody = $row ['rule_body'];
        $point = $row ['point'];
        $course_id = $row ['course_id'];
        $subject_id = $row ['subject_id'];
        $$difficultylevelIdevelId = $row ['difficultylevel_id'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <?php
require '../include/header.php';
?>
</head>
<body class="no-skin">
  <div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
            try{ace.settings.loadState('main-container')}catch(e){}
        </script>
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <i class="ace-icon fa fa-home home-icon"></i> <a href="#">首页</a>
        </li>
        <li>
          <a href="#">课程管理</a>
        </li>
        <li>
          <a href="#">【课程名称】</a>
        </li>
        <li class="active">组卷规则</li>
      </ul>
    </div>
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
                <li class="">
          <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-right"></i><span class="menu-text">我的课程</span><b class="arrow fa fa-angle-down"></b></a> <b class="arrow"></b>
          <!-- todo: course list -->
          <ul class="submenu">
                    <?php
                    
$allCourses = getAllCourses ();
                    foreach ( $allCourses as $course ) {
                        ?>
                          <li class="">
              <a href="<?php echo $qb_url_root.'/question/question.php?courseid='.$course['course_id']?>"><i class="menu-icon fa fa-caret-right"></i><?php echo $course['course_name']?></a> <b class="arrow"></b>
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
              </a> <b class="arrow"></b>
            </li>
            <li class="">
              <a href="#"> <i class="menu-icon fa fa-caret-right"></i> 用户
              </a> <b class="arrow"></b>
            </li>
          </ul>
        </li>
        <li class="active open">
          <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-list"></i><span class="menu-text">课程管理</span> <b class="arrow fa fa-angle-down"></b>
          </a> <b class="arrow"></b>
          <ul class="submenu">
            <li class="">
              <a href="<?=$qb_url_root?>/subject/subject.php?courseid=<?=$courseid ?>"> <i class="menu-icon fa fa-caret-right"></i> 知识点
              </a> <b class="arrow"></b>
            </li>
            <li class="">
              <a href="<?php echo $qb_url_root?>/question/question.php?courseid=<?=$courseid ?>"> <i class="menu-icon fa fa-caret-right"></i> 题库
              </a> <b class="arrow"></b>
            </li>
            <li class="active">
              <a href="<?=$qb_url_root?>/rule/view.php?courseid=<?=$courseid ?>"> <i class="menu-icon fa fa-caret-right"></i> 组卷规则
              </a> <b class="arrow"></b>
            </li>
            <li class="">
              <a href="<?=$qb_url_root?>/question/zujuan.php?courseid=<?=$courseid ?>"> <i class="menu-icon fa fa-caret-right"></i> 手动组卷
              </a> <b class="arrow"></b>
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
        <div class="page-content">
          <div class="page-header">
            <h1>
              组卷规则<small><i class="ace-icon fa fa-angle-double-right"></i>CRUD</small>
            </h1>
          </div>
          <div class="row">
            <form class="form-horizontal" role="form" method ="post" action="ajax/ruleupdate.php" >
              <fieldset>
                <legend>基本信息</legend>
                <input type="hidden" name="courseid" value="<?= $courseid?>">
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="field-name">规则名称</label>
                  <div class="col-sm-9">
                    <input type="text" name="field-name" class="col-xs-10 col-sm-5" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="field-desc">说明</label>
                  <div class="col-sm-9">
                    <input type="text" name="field-desc" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="difficulty">试卷难度</label>
                  <div class="col-sm-9">
                    <div class="radio">
                      <label>
                        <input name="field-difficulty" type="radio" class="ace" /> <span class="lbl"> Easy</span>
                      </label>
                      <label>
                        <input name="field-difficulty" type="radio" class="ace" /> <span class="lbl"> Hard</span>
                      </label>
                    </div>
                  </div>
                </div>
                
              </fieldset>
              <fieldset>
              <legend>题型、题量设置</legend>
              <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="field-desc">题型</label>
                  <div class="col-sm-9">
                    <div class="checkbox">
                      <label>
                        <input name="field-checkbox-1" type="checkbox" class="ace" /> <span class="lbl">填空题</span>
                      </label>
                      <label>
                        <input name="field-checkbox-2" type="checkbox" class="ace" /> <span class="lbl">选择题</span>
                      </label>
                      <label>
                        <input name="field-checkbox-4" type="checkbox" class="ace" /> <span class="lbl">简答题</span>
                      </label>
                      <label>
                        <input name="field-checkbox-8" type="checkbox" class="ace" /> <span class="lbl">综合题</span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="field-name">简答题</label>
                  <div class="col-sm-9">
                    <input type="text" id="field-shortanswer" name="field-number-1" class="" />道题<span class="help-button"><i class="ace-icon fa fa-trash-o bigger-120"></i></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="field-name">选择题</label>
                  <div class="col-sm-9">
                    <input type="text" id="field-choice" name="field-number-2" class="" />道题<span class="help-button"><i class="ace-icon fa fa-trash-o bigger-120"></i></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="field-name">填空题</label>
                  <div class="col-sm-9">
                    <input type="text" id="field-fillblank" name="field-number-4" class="" />道题<span class="help-button"><i class="ace-icon fa fa-trash-o bigger-120"></i></span>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-9 col-sm-offset-3">
                    <button type="submit" class="btn btn-primary">保存</button>
                    <button type="button" class="btn btn-default" onclick="history.back();">取消</button>
                  </div>
                </div>
              </fieldset>
              
            </form>
          </div>
          
        </div>
      </div>
    </div>
    <!-- /.main-content -->
  </div>
  <!-- /.main-container -->    
   
     <?php
    require '../include/scripts.php';
    ?>
    <script src="../lib/jqueryvalidation/jquery.validate.js" type="text/javascript"></script>
    <script src="../lib/bootstrapValidator/js/bootstrapValidator.js" type="text/javascript"></script>
</body>
</html>