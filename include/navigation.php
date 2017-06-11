<!--  Navigation -->
<div class="navbar navbar-default navbar-fixedtop " role="navigation">
 <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-top-menu-collapse" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <img class="img-responsive" style="margin:10px 2px 2px 10px;float:left;" height="53" width="80" 
              src="<?php echo $CFG->wwwroot.'/images/question.png'?>" alt="question bank"/>
        <a class="navbar-brand" href="#">QuestionBank</a>
      </div>
      <div class="collapse navbar-collapse navbar-top-menu-collapse navbar-left">
        <ul class="nav navbar-nav">
          <li><a href="<?= $qb_url_root."/index.php"?>">首页</a></li>
          <li class="active dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">系统管理<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?=$qb_url_root.'course/course.php' ?>">课程管理</a></li>
              <li><a href="<?=$qb_url_root."subject/subject.php"?>">知识点管理</a></li>
              <li><a href="<?=$qb_url_root."rule/index.php"?>">组卷规则管理</a></li>
              <li><a href="<?=$qb_url_root."users/pages.php"?>">页面权限管理</a></li>
            </ul>
          </li>
          <li><a href="#">Rules</a></li>
        </ul>
      </div>
      <div class="collapse navbar-collapse navbar-top-menu-collapse navbar-right">
        <ul class="nav navbar-top-links">
          
          <?php if ($user->isLoggedIn() ){ //if logged in?>
          <li><a href="#"><i class="fa fa-fw fa-user"></i><?=$user->username() ?></a></li>
          <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <i class="fa fa-cog fa-fw"></i><i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                  <li><a href="#"><i class="fa fa-user fa-fw"></i>账号设置</a></li>
                  <li><a href="#"><i class="fa fa-gear fa-fw"></i>个人主页</a></li>
                  <li class="divider"></li>
                  <li><a href="<?php echo $CFG->wwwroot?>/logout.php"><i class="fa fa-sign-out fa-fw"></i>退出</a></li>
                </ul>
                <!-- /.dropdown-user -->
              </li>
              <!-- /.dropdown -->
           <?php } else { // no one is logged in, display default items?>
              <li><a href="<?=$CFG->wwwroot?>/login.php" class=""><i class="fa fa-sign-in"></i>Login</a></li>
           <?php } ?>
        </ul> <!-- End of UL for navigation  -->
      </div>
  </div>
</div>
