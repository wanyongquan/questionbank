<?php
/**
 * Yan Lao Shi Ti Ku
 * An PHP Question Bank Management System
 * @author Wanyongquan
 */
/*
 * This page is user management dashboard. it shows all users in a grid .
 */
// Report all PHP errors
error_reporting(-1);

require_once '../config.php';

require_once '../includes/html_header.php';

if (!loginRequired($_SERVER['REQUEST_URI'])){die();}

$mode = $_REQUEST['mode'];
if (empty($mode)|| !($mode == 'm' || $mode == 'i')){
    header('location', '../index.php');
}

$courseData = fetchAllCourses();

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
                <!--  <h3><?php echo get_string('manualzujuan'); ?></h3>-->
               <div class="nav" style="float:left; font-size:16px;">
                   <ul class="breadcrumb">
                     <li class=""><i class="fa fa-home"></i> <a href="#">Home</a></li>
                     <li class=""><a href="#"><?= $mode == 'm' ? '手动组卷' : '智能组卷'?></a></li>
                   </ul>
              </div>
             </div>
              
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?=get_string('choosecourse') ?></h2>
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
                    <div class="row">
                     
                      <?php 
                      foreach ($courseData as $vl ){
                      ?>
                      <div class="col-md-4 col-xs-4 col-sm-12">
                        <div class="well" style="overflow:auto">
                          <?php 
                          switch ($mode){
                              case 'm':
                                  $url = $qb_url_root .'/zujuan/pickquestions.php?courseid='.$vl['course_id'];
                                  break;
                              case 'i':
                                  $url = $qb_url_root .'/zujuan/autogenerating.php?courseid='.$vl['course_id'];
                                  break;
                          }
                          ?>
                          <h3><a href="<?=$url?>" ><?=$vl['coursename'] ?></a></h3>
                        </div>
                      </div>
                      <?php } ?>
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
    <script src="<?php echo $qb_url_root?>/vendors/select2/dist/js/select2.full.min.js"></script>
    
    <script>
     $(function(){
    	 $('.select2').select2()
     });
    </script>
    
  </body>
</html>
