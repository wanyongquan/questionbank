<?php
require_once '../config.php';

require_once '../includes/html_header.php';

require_once '../lib/datelib.php';



    $courseid = $_REQUEST['id'];
    $questions = getCourseQuestions($courseid);
    
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
                <h3>全部可用课程</h3>
              </div>
            </div>
            
            <div class="clearfix"></div>
            
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Course</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <h2>hello</h2>
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
    <!-- FastClick -->
    <script src="<?php echo $qb_url_root?>/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo $qb_url_root?>/vendors/nprogress/nprogress.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo $qb_url_root?>/js/custom.min.js"></script>
  </body>
</html>


 