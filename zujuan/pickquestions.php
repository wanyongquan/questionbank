<?php
/*
 *  YanZi TIKU
 *  A Question Management and Test Paper Generator System
 *
 *  Developer: Wan Yongquan
 *  Title:  Test papers management:edit,delete
 */
?>
<?php  require_once '../config.php';?>
<?php  require_once '../includes/html_header.php';?>

<?php  if (!loginRequired($_SERVER['REQUEST_URI'])){die();} ?>
<?php 
// PHP goes here!
$courseId = $_REQUEST['courseid'];
if(!isset($courseId)){
    Redirect::to($qb_url_root.'/zujuan/zujuan.php');
}
$questionData = getCourseQuestions($courseId);
$questionCart = $_SESSION['question_cart'];
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
                <h3>Page Title</h3>
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
                      
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="filter-item-wrap">
                          <div class="filter-item ">
                            <div class="filter-head">知识点
                            </div>
                            <div class="filter-value">
                              <div class="filter-value-inner"> <select id="ques_subject" class="select2 form-control">
                                  <option value="-1"> All</option>
                                <?php $subjectData = getCourseSubjects($courseId);
                                foreach($subjectData as $subject){
                                ?>
                                  <option value=""><?=$subject['subjectname'] ?></option>
                                  
                                <?php } ?>
                                </select>
                             </div>
                            </div>
                           </div>
                          <div class="filter-item ">
                            <div class="filter-head">题型
                            </div>
                            <div class="filter-value">
                                <ul>
                                  <li><a>choice</a></li> <li><a>shortanswer</a></li><li><a>this is a very long option </a></li>
                                </ul>
                            </div>
                          </div>
                          <div class="filter-item ">
                            <div class="filter-head">难度
                            </div>
                            <div class="filter-value">
                                <ul>
                                  <li><a>easy</a></li> <li><a>hard</a></li>
                                </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                      <?php 
                      foreach($questionData as $vl){
                          $questionid= $vl['question_id'];
                         $incart = cart_question_exists($questionid, $questionCart);
                      ?>
                        <div class="panel panel-default question-wrap">
                          <div class="panel-heading"><?=$vl['id'] ?>difficulty, <span>难度:<?=$vl['difficulty'] ?></span>, count 
                          <a class="pull-right <?= ($incart)? 'remove-btn': 'add-btn'?>" href="#" data-id="<?=$vl['question_id'] ?>" onclick="addtocart(this)">
                            <i class="fa <?=($incart)? 'fa-minus':'fa-plus' ?>"></i><?=($incart)?get_string('removecart'): get_string('addcart')?> </a>
                          </div>
                          <div class="panel-body">
                            <div class="ques-body"><?=$vl['question_body'] ?></div>
                            <div class="ques_answer">
                            <?php $quesAnswer = getQuestionAnswers($vl['question_id']);
                            foreach($quesAnswer as $ques){
                            ?>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                             <?=$ques['answerlabel'] ?><span>.</span><span><?=$ques['answer'] ?></span>
                            </div>
                            <?php } ?>
                            </div>
                          </div>
                        </div>
                     <?php }?> 
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
    <script src="../js/pagination/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../js/pagination/dataTables.js" type="text/javascript"></script>
    <script src="../js/pickquestions.js"></script>
    <script src="<?php echo $qb_url_root?>/vendors/select2/dist/js/select2.full.min.js"></script>
    
    <script>
     $(function(){
         $('.select2').select2()
     });
    </script>
  </body>
</html>
