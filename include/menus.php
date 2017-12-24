
<nav class="navbar navbar-default navbar-fixedtop">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=<?php echo $CFG->wwwroot."/index2.php#"?>>Question Bank</a>
        </div>
        <div class="collapse navbar-collapse navbar-top-menu-collapse navbar-left">
            <ul class="nav navbar-nav">
                <li>
                    <a href=<?php echo $CFG->wwwroot."/index2.php"?>>首页</a>
                </li>
                <li class="dropdown active">
                    <a href="#" id="coursemgmt" class="dropdown-toggle" data-toggle="dropdown" role="menu" aria-haspopup="true" aria-expanded="false"> 系统管理<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= $qb_url_root.'/course/course.php'?>">课程管理</a>
                        </li>
                        <li>
                            <a href="<?php echo $CFG->wwwroot.'/subject/subject.php'?>">知识点管理</a>
                        </li>
                        <li>
                            <a href="<?=$CFG->wwwroot.'/users/pages.php' ?>">页面权限管理</a>
                    
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 题目管理<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo $CFG->wwwroot.'/question/question.php'?>">浏览题目</a>
                        </li>
                        <li>
                            <a href="">录入题目</a>
                        </li>
                        <li>
                            <a href="">修改题目</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 组卷规则管理<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo $CFG->wwwroot.'/rule/index.php'?>">浏览规则</a>
                        </li>
                        <li>
                            <a href="">录入规则</a>
                        </li>
                        <li>
                            <a href="">修改规则</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 组卷<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="">浏览试卷</a>
                        </li>
                        <li>
                            <a href="">组卷</a>
                        </li>
                        <li>
                            <a href="">修改试卷</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 账户管理<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="">个人资料</a>
                        </li>
                        <li>
                            <a href="">修改密码</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse navbar-top-menu-collapse navbar-right">
            <ul class="nav navbar-top-links">
                  <?php if ($user->isLoggedIn() ){ //if logged in?>
                    <li>
                    <a href="#"> <i class="fa fa-fw fa-user"></i><?=$user->username() ?></a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-cog fa-fw"></i><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="#"> <i class="fa fa-user fa-fw"></i>账号设置
                            </a>
                        </li>
                        <li>
                            <a href="#"> <i class="fa fa-gear fa-fw"></i>个人主页
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo $CFG->wwwroot?>/logout.php"> <i class="fa fa-sign-out fa-fw"></i>退出
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
                <?php } else { // no one is logged in, display default items?>
                    <li>
                    <a href="<?=$CFG->wwwroot?>/login.php" class=""> <i class="fa fa-sign-in"></i>Login
                    </a>
                </li>
                <?php } ?>
                </ul>
            <!-- End of UL for navigation  -->
        </div>
    </div>
</nav>
