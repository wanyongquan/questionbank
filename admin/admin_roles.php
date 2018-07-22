<?php
/*
 * ****************************************************
 * ** Yan Lao Shi Question Management System        ***
 * **-----------------------------------------------***
 * ** Developer: Wan Yongquan                       ***
 * ** Title: Role Management                        ***
 * ** Function: Add,Edit,Delete                     ***
 * ****************************************************        
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

if (!loginRequired($_SERVER['REQUEST_URI'])){die();}

$roledata = getAllRoles();
?>
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
                <h3>Role Management</h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Plain Page</h2>
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
                     <!-- left column -->
                     <div class="class col-sm-3"></div>
                     <!-- main content column -->
                     <div class="class col-sm-6">
                        <form name="addRole" action="<?=$_SERVER['REQUEST_URI']?>" method = "post">
                          <h2> Create a new role</h2>
                          <p>
                            <label>Role Name:</label>
                            <input name="name" type="text"/>
                            <input class="btn btn-primary" type="submit" name="submit" value="Add Role"/><br>
                          </p>
                        </form>
                        <br>
                        <table class="table table-hover table-list-search">
                          <tr><th>Role Name</th></tr>
                          <?php 
                           // list every role name here
                          foreach($roledata as $row){
                          ?>
                          <tr>
                            <td><a href="admin_role.php?id=<?= $row['id']?>"><?=$row['name']?></a>
                          </tr>
                          
                          <?php 
                          }
                          ?>
                        </table>
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
