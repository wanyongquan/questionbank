        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>    

              <ul class="nav navbar-nav navbar-right">
                <?php 
                if ($user && $user->isLoggedin()  ){
                ?>
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $qb_url_root?>/images/img.jpg" alt=""><?=$user->_fname ?>&nbsp;&nbsp;<?=$user->_lname ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="<?php echo $qb_url_root?>/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
                <?php } else{?>
                <li><a href="<?=$qb_url_root?>/login.php"><i class="fa fa-fw fa-sign-in"></i> Log in</a></li> 
                <li><a href="<?=$qb_url_root?>"><i class="fa fa-fw fa-home"></i> Home</a></li> 
                <?php  } ?>
              </ul>
              
            <!-- /.navar-left -->
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
