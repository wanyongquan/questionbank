<?php
/*
 ***************************************************
 ** WanXin Test Paper Generator System            **
 **-----------------------------------------------**
 ** Developer: Wan Yongquan                       **
 ** Title: Admin Dashboard                        **
 ** Function: User Management, Role Management    **
 ***************************************************        
 */

/* 
 * ***********************************************
 * ---------------*
 * PHP goes here  *
 * ---------------*
 

 *************************************************
 */
require_once '../config.php';

require_once '../includes/html_header.php';
?>
<link href="../css/admin.css" rel="stylesheet">
<link href="<?php echo $qb_url_root?>/css/admin.css" rel="stylesheet">
    <div class="container body">
      <div class="main_container">
        <?php require_once $abs_doc_root.$qb_url_root.'/includes/menu.php';?>
        
        <!-- top navigation -->
        <?php   require_once $abs_doc_root.$qb_url_root."/includes/topnavigation.php";  ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>后台管理</h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?=get_string('admin-dashboard')?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     
                      <div class="row row-centered">
                        <a href="<?php echo $qb_url_root?>/admin/admin_users.php"><div class="col-md-3 col-sm-3 col-xs- col-centered">
                          <div class="panel panel-default">
                            <i class="fa fa-users fa-2x"></i><br><?=get_string('usermanagement')?></li>
                          </div>
                        </div></a>
                        
                        <a href="<?php echo $qb_url_root?>/admin/admin_roles.php"><div class="col-md-3 col-sm-3 col-xs- col-centered">
                          <div class="panel panel-default">
                            <i class="fa fa-lock fa-2x"></i><br><?=get_string('rolemanagement')?></li>
                          </div>
                        </div></a>
                        
                        <a href="<?php echo $qb_url_root?>/admin/admin_pages.php"><div class="col-md-3 col-sm-3 col-xs- col-centered">
                          <div class="panel panel-default">
                            <i class="fa fa-lock fa-2x"></i><br><?=get_string('pagemanagement')?></li>
                          </div>
                        </div></a>
                        
                        <a href="<?php echo $qb_url_root?>/admin/admin_courses.php"><div class="col-md-3 col-sm-3 col-xs- col-centered">
                          <div class="panel panel-default">
                            <i class="fa fa-lock fa-2x"></i><br><?=get_string('course-management')?></li>
                          </div>
                        </div></a>
                      </div>
                      
                  </div><!-- /x_content -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <?php echo get_string('title'); ?> 技术支持：Wan Yongquan
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo $qb_url_root?>/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo $qb_url_root?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo $qb_url_root?>/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo $qb_url_root?>/vendors/nprogress/nprogress.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo $qb_url_root?>/js/custom.min.js"></script>
  </body>
</html>
