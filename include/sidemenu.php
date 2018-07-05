      <!-- Nav -->
      <nav class="navbar navbar-default nav-bar-static-top" role="navigation" style="margin-bottom:0">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <img style="margin:10px 2px 2px 10px;float:left;" height="53" width="80" 
          src="images/question.png" alt="question bank"/>
          <a class="navbar-brand" href="index.php">Question Bank</a>
          
        </div>
        <!-- /.navbar-header -->
        <div class="collapse navbar-collapse navbar-top-menu-collapse navbar-right">
        
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="fa fa-user fa-fw"></i><i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
              <li><a href="#"><i class="fa fa-user fa-fw"></i>User Profile</a></li>
              <li><a href="#"><i class="fa fa-gear fa-fw"></i>Settings</a></li>
              <li class="divider"></li>
              <li><a href="<?php echo $CFG->wwwroot?>/login.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a></li>
            </ul>
            <!-- /.dropdown-user -->
          </li>
          <!-- /.dropdown -->
        </ul>
        </div>
        <!-- /.navbar-top-links -->
        <div class="navbar-default sidebar" role="navigation">
          <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
              <li> <a href="index.php"><i class="fa fa-dashboard fa-fw"></i>网站首页</a>
              </li>
              <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i>课程<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                  <li>
                    <a href="">课程1</a>
                  </li>
                  <li>
                    <a href="<?php echo $CFG->wwwroot.'/subject/subject.php'?>">课程2</a>
                  </li>
                  <li>
                    <a href="">课程3</a>
                  </li>
                  <li>
                    <a href="">课程4</a>
                  </li>
                </ul>
              </li>
              <!-- /.Second Level -->
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
                  <li>
                    <a href="<?php echo $CFG->wwwroot.'/users/pages.php'?>">页面权限</a>
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