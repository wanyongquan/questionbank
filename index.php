<?php
/**
 * Yan Lao Shi Ti Ku
 * An PHP Question Bank Management System
 * @author Wanyongquan
 */
/*
 * This page is user management dashboard. it shows all users in a grid .
 */
require_once 'config.php';

require_once 'includes/html_header.php';
require_once 'classes/Class.User.php';

if (!loginRequired($_SERVER['REQUEST_URI'])){die();}


$myQuestionData = getMyTopNQuestions(5);
$myPapers = getMyTopNPapers(5);
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
                 <div class="nav" style="float:left; font-size:16px;">
                   <ul class="breadcrumb">
                     <li class=""><i class="fa fa-home"></i> <a href="#"><?=get_string('home') ?></a></li>
                     
                   </ul>
                 </div>
              </div>

            </div>

            <div class="clearfix"></div>
                  <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-white">
            <div class="inner">
              <h3>试题数量</h3>

              <p>1200</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="<?= $qb_url_root?>/question/index.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-white">
            <div class="inner">
              <h3>试卷数量</h3>

              <p>120</p>
            </div>
            <div class="icon">
              <i class="fa fa-list"></i>
            </div>
            <a href="<?= $qb_url_root?>/zujuan/testpapers.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-white">
            <div class="inner">
              <h3>知识点</h3>

              <p>54</p>
            </div>
            <div class="icon">
              <i class="fa fa-star"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-white">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <br>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?='最新试题' ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="" href="<?= $qb_url_root?>/question/index.php">更多<i class="fa fa-chevron-right"></i> </a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     
                      <ul class="list-unstyled">
                      <?php 
                      foreach ($myQuestionData as $vl ){
                      ?>
                      <li >
                      <div class="detail-list"><h2> <a href="#" class="  "><?=$vl['question_body'] ?></a></h2>
                        
                      </div>
                      <div style="float:right"> <?=$vl['Created_Date'] ?></div>
                      <div class="clearfix"></div>
                      </li>
                      <?php } ?>
                      </ul>
                     
                  </div>
                </div>
              </div>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?='最近试卷' ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="" href="<?= $qb_url_root?>/zujuan/testpapers.php">更多<i class="fa fa-chevron-right"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     <ul class="list-unstyled">
                      <?php 
                      foreach ($myPapers as $vl ){
                      ?>
                      <li>
                      <div class="detail-list" >
                        <h2> <a href="<?= $qb_url_root?>/question/admin_questions.php?courseid=<?=$vl['course_id'] ?>" class="  "><?=$vl['title'] ?></a></h2>
                      </div>
                      <div style="float:right"> <?=$vl['Created_Date'] ?></div>
                      <div class="clearfix"></div>
                      </li>
                      <?php } ?>
                     </ul>
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
