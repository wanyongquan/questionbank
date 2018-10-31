<?php
/*
 *  YanZi TIKU
 *  A Question Management and Test Paper Generator System
 *
 *  Developer: Wan Yongquan
 *  Copyright: 2018
 */
?>
<?php  require_once '../config.php';?>
<?php require_once '../includes/html_header.php';?>

<?php 
if (!loginRequired($_SERVER['REQUEST_URI'])){die();}

$courseId = $_REQUEST['courseid'];
$courseDetail = getCourseDetails($courseId);
$coursename = $courseDetail['coursename'];

$difficultyData = getDifficultyLevels();
$qtypeData = getQtypes();
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
                     <li class=""><a href="#"><?=‘智能组卷’ ?></a></li>
                   </ul>
                 </div>
                 
              </div>
                <div class="navbar-right ">
                   <div class="page-head-right">
                   当前课程：<?= $coursename?></div>
                 
                 </div>
            </div>

            <div class="clearfix"></div>
            <input type="hidden" id="courseId" value="<?=$courseId?>">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>试卷设置</h2>
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
                       <input id="currCourse" name="currCourse" type="hidden" value="<?=$courseId ?>">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">选择知识点
                                </div>
                                <div class="panel-body">
                                    <div id="tree"> </div>
                                </div>
                            </div>
                        </div>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                      <form id="i-condition-frm" method="post" class="form-horizontal" role="form" >
                      <input type="hidden" name="why" value="what">
                      <div class="i-filter-box i-filter-subject" >
                           <div class="i-filter-head"> 已选知识点</div>
                           <div class="tag-list">
                             <div id="choosenSubjectTags" style="height:100%; overflow:hidden"></div>
                                
                           </div>
                      </div>
                      <div class="i-filter-box " >
                           <div class="i-filter-head"> 试卷设置</div>
                           <div class="i-filter-item">
                           <div class="i-filter-left f-left">
                             <span class="f-left filter-label" >试卷难度</span>
                             <div style="float:left">
                                <ul class="list-unstyled " > 
                                <?php foreach($difficultyData as $vl){
                                    ?>
                                    <li class="f-left" ><div class="filter-option">
                                        <label><input type="radio" value="<?=$vl['id'] ?>" id="radio<?=$vl['id'] ?>" name="difficulty_option"> <?=$vl['item_name'] ?> 
                                    </label></div>
                                   </li>    
                                <?php  
                                }?>
                                  
                                 
                                </ul>
                             </div>   
                           </div>
                         </div>
                      </div>
                      <div class="i-filter-box">
                          <div class="i-filter-head">设置题型和数量</div>
                          <?php  foreach($qtypeData as $vl){
                              
                              ?>
                          <div class="i-filter-item">
                           <div class="i-filter-left f-left">
                            <span  class="f-left" style="width:60px"><?=$vl['item_name'] ?></span>
                            <div style="float:left"> <input type="text" id="<?=$vl['item_value'] ?>" readonly placeholder="0" class="filter-text"> 道题可用</div> </div>
                           <div class="i-filter-right f-right" >
                              <div class="filter-right-wrap">
                              <input type="number" class="emphasis " style="height:26px" id="<?=$vl['item_value'] ?>_demand" name="<?=$vl['item_value']?>_demand" max="0" min="0" placeholder="0"><i class="fa fa-trash-o"></i> </div> 
                              </div>
                           </div>
                          <?php } ?>
                 <!--   <div class="i-filter-item">
                           <div class="i-filter-left f-left">
                            <span  class="f-left" style="width:60px">填空题 </span>
                            <div style="float:left"> <input type="text" id="fillblank" readonly placeholder="0" class="filter-text" > 道题可用</div> </div>
                           <div class="i-filter-right f-right" >
                              <div class="filter-right-wrap"> 
                              <input type="number" style="text-align:center" class="emphasis" id="fillblank_demand" name="fillblank_demand" max="0" min="0" placeholder="0"><i class="fa fa-trash-o"></i> </div> 
                              </div>
                           </div>
                            <div class="i-filter-item">
                           <div class="i-filter-left f-left">
                            <span  class="f-left" style="width:60px">简答题 </span>
                            <div style="float:left"> <input type="text" id="shortanswer" readonly placeholder="0"  class="filter-text"> 道题可用</div> </div>
                           <div class="i-filter-right f-right" >
                              <div class="filter-right-wrap">
                              <input type="number" class="emphasis" id="shortanswer_demand" name="shortanswer_demand" max="0" min="0" placeholder="0"><i class="fa fa-trash-o"></i> </div> 
                              </div>
                           </div>
                           -->
                      </div>
                      <div> 
                        <a href="#" class="btn btn-primary" id="generate" onclick="submitForm();">生成试卷</a>
                      </div>
                      </form>
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
    <script src="../lib/bootstrap-treeview/js/bootstrap-treeview.js"></script>
     <link href="../lib/jquery-ui/jquery-ui.css" rel="stylesheet">
     <script src="../lib/jquery-ui/jquery-ui.min.js"></script>
    <script src="../js/condition.js"></script>
  </body>
</html>
