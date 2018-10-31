            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>导航</h3>
                <ul class="nav side-menu">
                  <li><a href="<?php echo $qb_url_root?>/index.php"><i class="fa fa-home"></i> 首页 </a>
                    
                  </li>
                  <li><a href="<?php echo $qb_url_root?>/question/index.php"><i class="fa fa-graduation-cap"></i> <?=get_string('question_title') ?> </a> </li>
                  <li><a href="<?php echo $qb_url_root?>/zujuan/testpapers.php"><i class="fa fa-pencil-square-o"></i> <?=get_string('testpapers'); ?> </a> </li>
                  <li><a href="<?php echo $qb_url_root?>/course/admin_courses.php"><i class="fa fa-graduation-cap"></i> <?=get_string('coursemanagement') ?> </a> </li>
                  <li><a href="<?php echo $qb_url_root?>/zujuan/zujuan.php?mode=m"><i class="fa fa-pencil-square-o"></i> <?=get_string('manualzujuan'); ?> </a> </li>
                  <li><a href="<?php echo $qb_url_root?>/zujuan/zujuan.php?mode=i"><i class="fa fa-pencil-square-o"></i> <?=get_string('aizujuan') ?> </a> </li>
                  
                </ul>
              </div>
              <div class="menu_section">
               
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-cogs"></i> 系统管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo $qb_url_root?>/admin/admin.php"><i class="fa fa-dashboard"></i><?=get_string('dashboard'); ?> </a></li>
                      <li><a href="<?php echo $qb_url_root?>/admin/admin_users.php"><i class="fa fa-user"></i><?=get_string('usermanagement') ?> </a></li>
                      <li><a href="<?php echo $qb_url_root?>/admin/admin_roles.php"><i class="fa fa-users"></i><?=get_string('rolemanagement') ?></a></li>
                      <li><a href="<?php echo $qb_url_root?>/admin/admin_pages.php"><i class="fa fa-wrench"></i><?=get_string('pagemanagement') ?></a></li>    
                     <!--  <li><a href="<?php echo $qb_url_root?>/course/admin_courses.php"><i class="fa fa-book"></i><?=get_string('coursemanagement') ?></a></li> -->  
                    </ul>
                  </li>
                  
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->