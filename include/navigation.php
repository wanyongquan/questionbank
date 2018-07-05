
<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
        </button>
        <div class="navbar-header pull-left">
            <a href="<?php echo $qb_url_root.'/index2.php'?>" class="navbar-brand"> <small><i class="fa fa-leaf"></i><?php echo get_string('title'); ?></small>
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
<!-- /navbar -->