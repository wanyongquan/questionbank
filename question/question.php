<?php
include_once '../config.php';

include_once '../session.php';
include_once '../lib/datelib.php';
include_once 'lib.php';

error_reporting ( 1 );
    $courseId = $_REQUEST['courseid'];
    $questions = getQuestionsByCourseId($courseId);
    
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>燕子题库</title>
<!-- the above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<!-- Bootstrap core CSS -->
<link href="../lib/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- MetisMenu CSS -->
<link href="../lib/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
<!-- SB Admin 2 CSS -->
<link href="../lib/sb-admin-2/css/sb-admin-2.css" rel="stylesheet">
<!-- Morris Charts CSS -->
<link href="../lib/vendor/morrisjs/morris.css" rel="stylesheet">
<!-- Font Awesome CSS -->
<link href="../lib/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- Custom css -->
<link href="../css/footer.css" rel="stylesheet">
<link href="../css/all.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
            <?php
            require_once $abs_doc_root . $app_root . '/include/navigation.php';
            ?>
        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">TODO: 首页>课程>课程名称>题库</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            题库
                            <div class="pull-right">
                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#choose_questiontype_modal" data-backdrop="false">新增试题</button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="question_content">
                                <!-- question content table starts here -->
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr><th>名称</th><th>题型</th><th>难度</th><th>知识点</th><th>分数</th><th>创建人</th><th>创建日期</th><th>操作</th></thead>
                                    <tbody>                                      
                                <?php 
                                if (isset($questions)){
                                    foreach ($questions as $question){
                                        echo '<tr>';
                                        echo '<td>'.$question['question_name'].'</td>';
                                        echo '<td>'.$question['qtype'].'</td>';
                                        echo '<td>'.$question['difficultyLevel'].'</td>';
                                        echo '<td>'.$question['subject_name'].'</td>';
                                        echo '<td>'.$question['point'].'</td>';
                                        echo '<td>'.$question['createdBy'].'</td>';
                                        echo '<td>'.$question['createdDate'].'</td>';
                                        echo '<td><a title="Edit" href="#"><i class="fa fa-edit fa-fw"></i>编辑</a>&nbsp;&nbsp;';
                                        echo '<a  data-id="'.$question['question_id'].'" data-toggle="modal" data-target="#delete_question_modal"
                           data-backdrop="false"><i class="fa fa-trash-o fa-fw"></i>删除</a></td>';
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
        <!-- /.page-wrapper -->
    </div>
    <!-- /.wrapper -->
    <!--  Modal dialog for add question -->
    <div id="choose_questiontype_modal" class="modal fade" role="dialog">
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
                                            <ul class="nav navbar-nav">
                                                <li class="active">
                                                    <label>
                                                        <input id="option1" type="radio" name="questiontype" value="multichoice" required data-error="please choose at least one question type"></input> <span class="typename">选择题</span>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btnAddQuestion">添加</button>
                </div>
                <!-- End of modal footer -->
            </div>
            <!-- End of modal content -->
        </div>
        <!-- End of modal dialog -->
    </div>
    <!-- End of Modal  -->
    <!--  Modal dialog for delete   -->
    <div id="delete_question_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Question</h4>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete this question?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <a class="btn btn-danger btn-ok" onclick="deleteQuestion(this)">Delete</a>
                </div>
                <!--  end of modal-footer -->
            </div>
            <!--  end of modal-content -->
        </div>
        <!--  end of modal-dialog -->
    </div>
    <!--  end of modal -->
    <!--  end of modal delete -->
    <!-- jQuery -->
    <script src="<?=$qb_url_root?>/lib/vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?=$qb_url_root?>/lib/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=$qb_url_root?>/lib/vendor/metisMenu/metisMenu.min.js"></script>
    <!-- Morris Charts JavaScript -->
    <script src="<?=$qb_url_root?>/lib/vendor/raphael/raphael.min.js"></script>
    <script src="<?=$qb_url_root?>/lib/vendor/morrisjs/morris.min.js"></script>
    <script src="<?=$qb_url_root?>/lib/vendor/data/morris-data.js"></script>
    <!-- Sb Admin 2 Theme JavaScript -->
    <script src="<?=$qb_url_root?>/lib/sb-admin-2/js/sb-admin-2.js"></script>
    <!-- Form validation JavaScript -->
    <script src="<?=$qb_url_root?>/script/form-validator.min.js" type="text/javascript"></script>
    <script src="question.js" type="text/javascript"></script>
</body>
</html>