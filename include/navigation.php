
<!-- Navigation -->
<nav class="navbar navbar-default nav-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo $qb_url_root?>/index2.php">燕子题库</a>
    </div>
    <!-- ./navbar-header -->
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
                    <a href="<?php echo $qb_url_root?>/logout.php"><i class="fa fa-sign-out fa-fw"></i>退出</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
           <?php } else { // no one is logged in, display default items?>
                <li>
            <a href="<?=$qb_url_root?>/login.php" class=""><i class="fa fa-sign-in"></i>登录</a>
        </li>
        <!-- /.dropdown -->
           <?php } ?>
            </ul>
    <!-- /.navbar-right-->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="<?php echo $qb_url_root?>/index2.php"><i class="fa fa-dashboard fa-fw"></i>仪表盘</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-table fa-fw"></i>基本数据<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?=$qb_url_root?>/course/course.php">课程</a>
                        </li>
                        <li>
                            <a href="<?=$qb_url_root?>/subject/subject.php">知识点</a>
                        </li>
                        <li>
                            <a href="<?=$qb_url_root?>/rule/rule.php">组卷规则</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href=""><i class="fa fa-wrench fa-fw"></i>课程<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php
                        $allCourses = getAllCourses ();
                        foreach ( $allCourses as $course ) {
                            ?>
                         <li>
                            <a href="<?php echo $qb_url_root.'/question/question.php?courseid='.$course['course_id']?>"><?php echo $course['course_name']?></a>
                        </li>                       
                    <?php }?>    
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- ./sidebar -->
</nav>
<!-- /nagivation -->