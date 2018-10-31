<?php
/**
 * Yan Lao Shi Ti Ku
 * An PHP Question Bank Management System              
 * @author Wanyongquan
 */
/*
 * This page is user management dashboard. it shows all users in a grid .
 */
require_once '../config.php';
require_once '../includes/html_header.php';
require_once '../classes/Redirect.php';

if (!loginRequired($_SERVER['REQUEST_URI'])){die();}

// show all users information
$pageData = getAllPages();

?>
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
                <h3>Page Title</h3>
                
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Page Management</h2>
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
                     
                  <!-- Page Heading -->
        <div class="row">
        <div class="col-sm-12">
           <div class="row">
              <hr />
              <div class="row">
                <div class="col-xs-12">
                  <div class="alluinfo">&nbsp;</div>
                  <div class="allutable">
                    <table id="paginate" class='table table-hover table-list-search'>
                      <thead>
                        <tr>
                          <th>id</th><th>Page Path</th><th>Page Name</th><th>Private</th>
                          </tr>
                        
                      </thead>
                      <tbody>
                        <?php
                        //Cycle through users
                        foreach ($pageData as $v1) {
                          ?>
                          <tr>
                            <td><?=$v1['id']?></td>
                            <td><a class="nounderline row-link" href='admin_page.php?id=<?=$v1['id']?>'><?=$v1['pagepath']?></a></td>
                            <td><a class="nounderline row-link" href='admin_page.php?id=<?=$v1['id']?>'><?=$v1['title']?></a></td>
                            <td><?=$v1['private']?> </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div><br>
            </div>

              </div>
            </div>
                  </div>
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
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo $qb_url_root?>/js/custom.min.js"></script>
   
    <script>
    $(document).ready(function() {
	    $('#paginate').DataTable({"pageLength": 25,"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]], "aaSorting": []});
	} );
    </script>
    <script src="../js/pagination/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../js/pagination/dataTables.js" type="text/javascript"></script>
  </body>
</html>
