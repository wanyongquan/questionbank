<?php

    include_once '../../config.php';

    include_once '../../session.php';
    include_once '../lib.php';

    if (isset($_SESSION['questiontype'])){
        $questiontype = $_SESSION['questiontype'];
    }

    $questionId = null;
    $question_name= null;
    $question_answer=null;
    if (!empty($_GET['id'])){
        $questionId = $_REQUEST['id'];
    }

    if (null != $questionId ){
        // for edit a existing question
        // get question details and show on page
        
        $result = getQuestionInfo($questionId);
        if (!$result ){
            //error
        }else{
            $row = mysqli_fetch_assoc($result);
            $question_id= $row['question_id'];
            $question_name= $row['question_name'];
            $qbody = $row['question_body'];
            
            $point = $row['point'];
            $subject_id= $row['subject_id'];
            $$difficultylevelIdevelId = $row['difficultylevel_id'];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <!-- the above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <!-- Bootstrap core CSS -->
        <link
            href="<?php echo $CFG->wwwroot.'/bootstrap/css/bootstrap.min.css'?>"
            rel="stylesheet">
        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../css/bootstrap.css" rel="stylesheet">
        <link href="../../css/nav-sidebar.css" rel="stylesheet">
        <link href="../../lib/bootstrapValidator/css/bootstrapValidator.css">
        <link href="../../css/all.css" rel="stylesheet">
        <title>Question Bank</title>
    </head>
<body>
    <?php
    if (isset ( $_SESSION['username'])){
         include '../../include/menus.php';
        }?>
    <div id="content" class="container">
      <div class="page-header"><h1>添加一道填空题</h1></div>
      <form name="question_form" id="question_form"  class="form-horizontal" 
        role="form" method="post" onsubmit="return onSubmitQForm();" data-toggle="validator">
       <fieldset>
            <legend>概要</legend>
            <input type="hidden" name="hidden_question_id" id="hidden_question_id" value="<?php echo (!empty($questionId) ? $questionId: '')?>">
            <div id="item_question_name" class="form-group">
                <div class="col-sm-2 control-label">
                    <label for="question_name">题目名称</label>
                </div>
                <div class="col-sm-8 col-lg-8">
                    <input id="question_name" name="question_name"
                        class="form-control" required
                        value="<?php echo !empty($question_name) ? $question_name: ''?>"></input>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="item_question_body" class="form-group">
               <div class="col-sm-2 control-label">
                    <label for="question_text">题干</label>
               </div>
               <div class="col-sm-8 col-lg-8">
                    <textarea id="question_body" name="question_body"   
                        class="field  form-control" rows="5" required ><?php echo !empty($qbody) ? $qbody:'';?></textarea>
                    <input type="hidden" value="fillblank" name="qtype">
                    <div class="help-block with-errors"></div>
               </div>
             </div>
         <div id="qitem_course" class="form-group">
            <div class="col-sm-2 control-label">
            <label for="question_mark">课程</label></div>
            <div class="col-sm-8 col-lg-8">
                <select id="qitem_course_id" name ="qitem_course_id" class="form-control ">
                    <option value="">--请选择课程--</option>
                <?php 
                    $courses = getCourses();
                    if ($courses->num_rows >0){
                        foreach ($courses as $course){
                            $courseselected = ($course_id == $course['course_id']) ? "selected": "";
                            echo  '<option value="'.$course['course_id'].'" '.$courseselected.' >'.$course['course_name'].'</option>';
                        }
                    }
                ?>    
                </select>
            </div>
         </div>
         <div class="form-group ">
               <div class="col-sm-2 control-label">
                 <label  for="subject_list">知识点</label>
               </div>
               <div class="col-sm-8 col-lg-8">
                <select id="subject_list"  name="subject_id" class="form-control">
                    s<option value="">--请选择知识点--</option>
                <?php
                $query = "select * from tk_subjects order by subject_id;";
    
                $result = $DB->query($query) or die(exit(mysqli_error($DB)));
    
                if ($result->num_rows >0){
                    foreach ($result as $row){
                        $selected = ($subject_id == $row['subject_id']) ? "selected": "";
                        echo  '<option value="'.$row['subject_id'].'" '.$selected.' >'.$row['subject_name'].'</option>';
                    }
                }
                ?>
                </select>
               </div>
             </div>
             <div class="form-group">
                <div class="col-sm-2 control-label" >
                <label for="difficultylevel_list">难度</label></div>
                <div class="col-sm-8 col-lg-8">
                <select id="difficultylevel_list"  name="difficultyLevel_id" class="form-control">
                    <option value="">--请选择难度--</option>
                <?php
                $query = 'select * from vw_difficultylevels';
    
                $result = $DB->query($query) or die(exit(mysqli_error($DB)));
    
                if ($result->num_rows > 0){
                    foreach ($result as $row){
                        $selected = ($difficultylevel_id ==$row['dictionary_id']) ? "selected" : "";
                        echo '<option value="'.$row['dictionary_id'].'"'. $selected .' >'.$row['dictionary_value'].'</option>';
                    }
                }
                ?>
                </select></div>
             </div>
             <div id="item_question_mark" class="form-group">
            <div class="col-sm-2 control-label">
                <label for="question_mark">分数</label>
            </div>
            <div class="col-sm-3">
                <input id="question_mark" name="question_mark" 
                    class="form-control"   
                    value="<?php echo !empty($point) ? $point: ''?>">
                </input>
                <div class="help-block with-errors"></div>
            </div>
         </div>
         </fieldset>
         <fieldset>
            <legend>答案</legend>
            <div id="item_question_answer1" class="form-group">
                <div class="col-sm-2 control-label">
                    <label for="answer_content1">答案1</label>
                </div>
                <div class="col-sm-8 col-lg-8">
                    <textarea id="answer_content1" name="answer_content1" 
                        class="field  form-control" rows="5" 
                        required><?php echo !empty($question_answer) ? $question_answer:'';?></textarea>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
         </fieldset>
        <div class="form-group">
            <div  class="col-sm-8 col-sm-offset-2">
                <button type="submit" class="btn btn-success">保存</button>
                <button type="button" class="btn btn-default" onclick="history.back();" >取消</button>
            </div>
        </div>
      </form>
    </div>
    <!-- Bootstrap core JavaScript================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../script/bootstrapValidator.min.js" type="text/javascript"></script>
    <!-- <script src="../../script/form-validator.min.js" type="text/javascript"></script> -->
    <script src="formutil.js" type="text/javascript"></script>
    <script src="../../lib/jqueryvalidation/jquery.validate.js" type="text/javascript"></script>
    <script src="../../lib/bootstrapValidator/js/bootstrapValidator.js" type="text/javascript"></script>
  </body>
</html>