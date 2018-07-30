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
<?php require_once '../includes/html_header.php';?>

<?php  if (!loginRequired($_SERVER['REQUEST_URI'])){die();} ?>
<? 
// PHP goes here!

$action = $_REQUEST['action'];
if (!empty($action) && $action == 'editpaper'){
    /***********section 1: edit paper *********/
    $paperId = $_SESSION['paperid'];
}

$questionCart = $_session['question_cart'];

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
                     
                      <div id="makepaperzone" class="col-md-9 col-sm-9 col-xs-9">
                      <!--   <?php 
                        if (!isset($questionCart)){
                            ?>
                        you have add no question in cart
                        <?php
                        }else{ 
                            $courseid = $questionCart['courseid'];
                            $qtypeArr = $questionCart['qtype_data'];
                        foreach($qtypeArr as $qtype=>$qid_arr){    
                        ?>
                        <div class="x_panel">
                          <div class="x_title">
                            <h2><?=$qtype ?></h2>
                            <ul class="nav navbar-right widget-toolbar">
                              <li><a class="collapse-link"><i class="fa fa-arrow-up"></i>Move up</a>
                              </li>
                              <li><a class="collapse-link"><i class="fa fa-arrow-down"></i>Move down</a>
                              </li>
                             
                            </ul>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                              <div > <input id="papertitle" class="form-control"></div>
                              <?php 
                              foreach ($qid_arr as $vl){
                                  $questionData = getQuestionDetails($vl);
                                  $ques = mysqli_fetch_assoc($questionData);
                              ?>
                              <div class="panel panel-default">
                                <div class="panel-heading">
                                <h5 style="float:left; margin: 5px 0 6px;">难度：easy  组卷次数：6 入库时间： 2018-8-1</h5>
                                <ul class="nav navbar-right widget-toolbar" >
                                  <li style="float:left"><a class="collapse-link" data-id="<?=$vl ?>" onclick="movequestionup(this)"><i class="fa fa-arrow-up"></i>Move up</a>
                                  </li>
                                  <li style="float:left"><a class="collapse-link" data-id="<?=$vl?>" onclick="movequestiondown(this)"><i class="fa fa-arrow-down"></i>Move down</a>
                                  </li>
                                 <li style="float:left"><a class="collapse-link" data-id="<?=$vl?>"><i class="fa fa-trash-o"></i>remove</a>
                                  </li>
                                </ul>
                                <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                 body : <?= $ques['question_body']; ?>
                                </div>
                              </div>
                              <?php } ?>
                          </div>
                        </div>
                        <?php } }?> --> 
                      </div><!-- /end of col-md-9 -->
                      <div class="col-md-3 col-sm-3 col-xs-3">
                        <h3> operation</h3>
                        
                        <div >
                        
                        <ul class="list-unstyled side_toolbar">
                          <li><a href="<?php echo isset($courseid)? $qb_url_root.'/zujuan/pickquestions.php?courseid='.$courseid:$qb_url_root.'/zujuan/zujuan.php'  ?>"><?=get_string('continueaddquestion') ?></a></li>
                          <li><a  href="#" data-toggle="modal" data-target="#confirmClear" data-backdrop="false"><?=get_string('clearcart') ?></a></li>
                          <li>
                            <a >试卷设置（标题）</a>
                          </li>
                          <li>
                            <a href="">分数设置</a>
                          </li>
                          <li>
                            <a href="#" data-toggle="modal" data-target="#paperAnalysis" data-backdrop="false">试题分析</a>
                          </li>
                        </ul>
                        <hr>
                        </div>
                        <ul class="list-unstyled user_data">
                          <li><a class="btn btn-primary" id="savepaper">save</a></li>
                          <li><a class="btn btn-primary" href="downloadword.php?id=<?= 17?>">download</a></li>
                          
                        </ul>
                        
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
     <div id="confirmClear" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?=get_string('prompt') ?></h4>
                </div>
                <div class="modal-body">
                    <h5 class="warningtext"><?=get_string('confirmclearcart') ?> </h5>
                    <p class="warningtext"><span class="red"><?=get_string('clearcartWarningtext') ?></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <a class="btn btn-primary btn-ok" onclick="clearcart(this)"><?=get_string('ok'); ?></a>
                </div>
                <!--  end of modal-footer -->
            </div>
            <!--  end of modal-content -->
        </div>
        <!--  end of modal-dialog -->
    </div> <!-- /end of confirmClear dialog -->
    <div id="paperAnalysis" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?=get_string('prompt') ?></h4>
                </div>
                <div class="modal-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                      <li class="active"> <a href="#qtypepane" data-toggle="tab" onclick="showQtypeChart()"><?=get_string('qtypedistribution') ?></a>
                      </li>
                      <li><a href="#subjectpane" data-toggle="tab"><?=get_string('subjectdistribution') ?></a>
                      </li>
                      <li><a href="#difficultypane" data-toggle="tab"><?=get_string('difficultydistribution') ?></a>
                      </li>
                      <li><a href="#overallpane" data-toggle="tab"><?=get_string('statisticsreport') ?></a>
                      </li>
                    </ul>
                    <!-- Tab Panes -->
                    <div class="tab-content">
                      <div class="tab-pane fade in active" id="qtypepane">
                        <h4>adf</h4>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div id="qtypedistribution" style="width:480px;height:360px"></div>
                          
                        </div>
                        <div class="clearfix"></div>
                      </div>
                      <div class="tab-pane fade" id="subjectpane">
                        <h4>Profile tab</h4>
                        <p>adsfadf</p>
                      </div>
                      <div class="tab-pane fade" id="difficulypane">
                        <h4>Profile tab</h4>
                        <p>difficulty</p>
                      </div>
                      <div class="tab-pane fade" id="overallpane">
                        <h4>Profile tab</h4>
                        <p>over all</p>
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <a class="btn btn-primary btn-ok" onclick="clearcart(this)"><?=get_string('ok'); ?></a>
                </div>
                <!--  end of modal-footer -->
            </div>
            <!--  end of modal-content -->
        </div>
        <!--  end of modal-dialog -->
    </div> <!-- /end of paperAnalysis dialog -->
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
     <script src="../vendors/echarts/dist/echarts.js"></script>
    <script src="../js/makepaper.js"></script>
  </body>
</html>