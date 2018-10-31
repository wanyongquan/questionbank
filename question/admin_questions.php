<?php
/**
 * Yan Lao Shi Ti Ku
 * An PHP Question Bank Management System
 * @author Wanyongquan
 */
/*
 * This page is user management dashboard. it shows all users in a grid .
 */
error_reporting(E_ALL);

require_once '../config.php';

require_once '../includes/html_header.php';

$courseId = $_REQUEST['courseid'];
$questionData = getCourseQuestions($courseId);
?>
    <div class="container body">
      <div class="main_container">
        <?php require_once $abs_doc_root.$qb_url_root.'/includes/menu.php';?>
    
        <!-- top navigation -->
        <?php   require_once "../includes/topnavigation.php";  ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <div class="nav" style="float:left; font-size:16px;">
                   <ul class="breadcrumb">
                     <li class=""><i class="fa fa-home"></i> <a href="<?php echo $qb_url_root?>/index.php"><?=get_string('home'); ?></a></li>
                     <li class=""><a href="#"><?=get_string('coursemanagement');?></a></li>
                     
                   </ul>
                </div>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?=get_string('my-question-bank');?></h2>
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
                      <a class="pull-right" href="#" data-toggle="modal" data-target="#newQuestion"><i class="glyphicon glyphicon-plus"></i> 新增试题</a>
                      <div class="col-xs-12 col-sm-12">
                       <table id="paginate" class="table table-hover table-list-search">
                            <thead>
                                <tr><th>名称</th><th>题型</th><th>难度</th><th>知识点</th><th>分数</th><th>创建人</th><th>创建日期</th><th>操作</th></thead>
                            <tbody>                                      
                        <?php 
                        if (isset($questionData)){
                            foreach ($questionData as $question){
                                echo '<tr>';
                                echo '<td>'.$question['question_body'].'</td>';
                                echo '<td>'.$question['qtype'].'</td>';
                                echo '<td>'.$question['difficulty'].'</td>';
                                echo '<td>'.$question['subjectname'].'</td>';
                                echo '<td>'.$question['point'].'</td>';
                                echo '<td>'.$question['creator'].'</td>';
                                echo '<td>'.$question['createdDate'].'</td>';
                                echo '<td><a title="编辑" href="'.$question['qtype'].'/edit.php?courseid='.$courseId.'&qid='.$question['question_id'].'">
                                            <span class="green"><i class="ace-icon fa fa-pencil bigger-120"></i></span></a>&nbsp;&nbsp;&nbsp;&nbsp;';
                                echo '<a title="删除" data-id="'.$question['question_id'].'" data-toggle="modal" data-target="#delete_question_modal"  data-backdrop="true">
                                            <span class="red"><i class="ace-icon fa fa-trash-o bigger-120"></i></span></a></td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                            </tbody>
                        </table>
                     </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

    <!--  Modal dialog for add question -->
    <div id="newQuestion" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">选择题型</h4>
                </div>
                <div class="modal-body">
                    <form id="choose_questiontype_form" method="post" class="form-horizontal" role="form" data-toggle="validator">
                        <input type="hidden" name="courseid" value="<?php echo $courseId?>">  
                        <div class="row">
                            <div class="col-sm-5 col-md-5 navbar-default ">
                                <div class="sidebar-nav">
                                    <div class="navbar  form-group " role="navigation">
                                        <div id="typeoptions" class="navbar-collapse collapse sidebar-navbar-collapse">
                                            <ul class="nav navbar-tabs tabs-left">
                                                <li class="active">
                                                    <label>
                                                        <input id="option1" type="radio" name="questiontype" value="multichoice" required data-error="please choose at least one question type"> <span class="typename">选择题</span>
                                                    </label>
                                                </li>
                                                <li class="">
                                                    <label>
                                                        <input id="option2" type="radio" name="questiontype" value="truefalse" required> <span class="typename">判断题</span>
                                                    </label>
                                                </li>
                                                <li class="">
                                                    <label>
                                                        <input id="option3" type="radio" name="questiontype" value="fillblank" required> <span class="typename">填空题</span>
                                                    </label>
                                                </li>
                                                <li class="">
                                                    <label>
                                                        <input id="option4" type="radio" name="questiontype" value="shortanswer" required> <span class="typename">简答题</span>
                                                    </label>
                                                </li>
                                                <li class="">
                                                    <label>
                                                        <input id="option5" type="radio" name="questiontype" value="genaral" required> <span class="typename">综合题</span>
                                                    </label>
                                                </li>
                                            </ul>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7  col-md-7 main">
                                <div class="summarycontent option1">从预先定义的选项中选择一个或多个做为答案。</div>
                                <div class="summarycontent option2">判断题目的正确或错误</div>
                                <div class="summarycontent option3">在空白处填入正确答案</div>
                                <div class="summarycontent option4">根据题目回答</div>
                                <div class="summarycontent option5">综合题目</div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary" id="btnAddQuestion">添加</button>
                </div>
                <!-- End of modal footer -->
            </div>
            <!-- End of modal content -->
        </div>
        <!-- End of modal dialog -->
    </div>
    <!-- End of newQuestionModal  -->
    
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
    <script src="<?=$qb_url_root?>/lib/bootstrapvalidator/js/bootstrapValidator.min.js" type="text/javascript"></script>
    <script src="question.js" type="text/javascript"></script>
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
