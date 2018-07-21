<?php
error_reporting ( 0 );

require_once '../config.php';
require_once '../includes/html_header.php';

    $courseid = $_REQUEST['courseid'];
if (!isset($courseid)){
    $_GLOBALS ['message']='missing paramater';
}
?>

<?php require_once '../lib/dblib.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <?php
require '../include/header.php';

?>
  <link rel="stylesheet" href="../lib/ace/assets/css/jquery-ui.custom.min.css" />
<link rel="stylesheet" href="../lib/ace/assets/css/chosen.min.css" />
</head>
<body class="no-skin">
  <div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
      <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
        <span class="sr-only">Toggle sidebar</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
      </button>
      <div class="navbar-header pull-left">
        <a href="<?php echo $qb_url_root?>/index2.php" class="navbar-brand"> <small><i class="fa fa-leaf"></i><?php echo get_string('title'); ?></small>
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
        <li>
          <a href="#">课程管理</a>
        </li>
        <li>
          <a href="<?php echo $qb_url_root.'/question/view.php?courseid='.$courseid?>">[课程名称]</a>
          <input type="hidden" name="courseid" value="<?php echo $courseid?>"/>
        </li>
        <li class="active">手动组卷</li>
      </ul>
    </div>
    <!-- /.breadcrumbs -->
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
              <a href="<?php echo $qb_url_root.'/question/view.php?courseid='.$course['course_id']?>"><i class="menu-icon fa fa-caret-right"></i><?php echo $course['coursename']?></a> <b class="arrow"></b>
            </li>
                    <?php }?>
                    </ul>
        </li>
                <?php }?>
                <li class="">
          <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-desktop"></i> <span class="menu-text">系统管理</span> <b class="arrow fa fa-angle-down"></b>
          </a> <b class="arrow"></b>
          <ul class="submenu">
            <li class="active">
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
          <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-list"></i> <span class="menu-text">课程管理</span> <b class="arrow fa fa-angle-down"></b>
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
            <li class="">
              <a href="<?=$qb_url_root?>/rule/view.php?courseid=<?=$courseid ?>"> <i class="menu-icon fa fa-caret-right"></i> 组卷规则
              </a> <b class="arrow"></b>
            </li>
            <li class="active">
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
    <!-- /.sidebar -->
    <div class="main-content">
      <div class="main-content-inner">
        <div class="page-content">
          <div class="page-header">
            <h1>
              手动组卷 <small><i class="ace-icon fa fa-angle-double-right"></i>根据知识点组卷</small>
            </h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <!-- <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add_new_course_modal" data-backdrop="false">新增课程</button> -->
                </div>
              </div>
              <div class="row">
                <div class="col-xs-2">
                  <div class="widget-box widget-color-green2">
                    <div class="widget-header">
                      <h4 class="widget-title lighter smaller">选择知识点</h4>
                    </div>
                    <div class="widget-body">
                      <div class="widget-main padding-8">
                        <ul id="tree-subjects" class="tree tree-unselectable tree-folder-select" role="tree">
                            <?php
                            $subjectsofcourse = getSubjects ();
                            if (isset ( $subjectsofcourse )) {
                                foreach ( $subjectsofcourse as $subject ) {
                                    ?>
                                <li class="tree-item" role="treeitem" data-treeid=<?=$subject['subject_id'] ?>>
                                <span class="tree-item-name"> <span class="tree-label"><?= $subject['subjectname'] ?></span>
                                </span>
                              </li>
                             <?php
                                }
                            }
                            ?>
                            </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-10">
                  <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                      <div class="profile-info-name">知识点：</div>
                      <div class="profile-info-value">
                        <input type="hidden" name="qtype"/>
                         <a href="#" class="active">全部</a> <a data-value="1" href="#">选择题</a> <a data-value="1" href="#">填空题</a> <a data-value="1" href="#">简答题</a>
                      </div>
                    </div>
                    <div class="profile-info-row">
                      <div class="profile-info-name">难度：</div>
                      <div class="profile-info-value">
                        <input type="hidden" name="difficulty"/>
                         <a href="#" class="active">全部</a> <a data-value="1" href="#">简答</a> <a data-value="1" href="#">普通</a> <a data-value="1" href="#">较难</a>
                      </div>
                    </div>
                  </div>
                  <div class="space-10"></div>
                  <div class="qlist"></div>
                  <div class="row">
                    <div class="col-xs-6"></div>
                    <div class="col-xs-6">
                      <ul class="pagination">
                        <li>
                          <a href="#">&laquo;</a>
                        </li>
                        <li>
                          <a href="#">1</a>
                        </li>
                        <li>
                          <a href="#">2</a>
                        </li>
                        <li>
                          <a href="#">3</a>
                        </li>
                        <li>
                          <a href="#">4</a>
                        </li>
                        <li>
                          <a href="#">5</a>
                        </li>
                        <li>
                          <a href="#">&raquo;</a>
                        </li>
                      </ul>
                    </div>
                  </div>                  
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
    <script src="../lib/ace/assets/js/jquery-ui.custom.min.js"></script>
  <script src="../lib/ace/assets/js/chosen.jquery.min.js"></script>
  <script type="text/javascript">
      jQuery(function($){
      
          if(!ace.vars['touch']) {
				$('.chosen-select').chosen({allow_single_deselect:true}); 
				//resize the chosen on window resize
		
				$(window)
				.off('resize.chosen')
				.on('resize.chosen', function() {
					$('.chosen-select').each(function() {
						 var $this = $(this);
						 $this.next().css({'width': $this.parent().width()});
					})
				}).trigger('resize.chosen');
				//resize chosen on sidebar collapse/expand
				$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
					if(event_name != 'sidebar_collapsed') return;
					$('.chosen-select').each(function() {
						 var $this = $(this);
						 $this.next().css({'width': $this.parent().width()});
					})
				});
		
		
				$('#chosen-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
					 else $('#form-field-select-4').removeClass('tag-input-style');
				});
			};

		//chosen plugin inside a modal will have a zero width because the select element is originally hidden
		//and its width cannot be determined.
		//so we set the width after modal is show
		$('#modal-form').on('shown.bs.modal', function () {
			if(!ace.vars['touch']) {
				$(this).find('.chosen-container').each(function(){
					$(this).find('a:first-child').css('width' , '210px');
					$(this).find('.chosen-drop').css('width' , '210px');
					$(this).find('.chosen-search input').css('width' , '200px');
				});
			}
		});
      });
    </script>
  <!-- page specific plugin scripts -->
  <script src="../lib/ace/assets/js/tree.min.js"></script>
  <script src="zujuan.js"></script>
</body>
</html>