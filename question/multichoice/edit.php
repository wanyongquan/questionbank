<?php

    include_once '../../config.php';

    include_once '../../session.php';
    include_once '../../lib/dblib.php';
    
    if (isset($_SESSION['questiontype'])){
        $questiontype = $_SESSION['questiontype'];
    }

    $id = null;
    $question_id=null;
    $question_name= null;
    $qbody = null;
    $point = null;
    $course_id=null;
    $subject_id=null;
    $difficultylevelid = null;
    
    if (!empty($_GET['id'])){
        $id = $_REQUEST['id'];
    }

    if (null != $id ){
        // for edit a existing question
        // get question details and show on page
        $query = "select * from tk_questions "
                ." left join tk_subjects on tk_subjects.subject_id = tk_questions.subject_id"
                ." left join vw_difficultylevels on vw_difficultylevels.dictionary_id = tk_questions.difficultylevel_id"
                . " where tk_questions.question_id=$id" ;
        $result = mysqli_query($DB, $query);
        if (!$result ){
            //error
        }else{
            $row = mysqli_fetch_assoc($result);
            $question_id= $row['question_id'];
            $question_name= $row['question_name'];
            $qbody = $row['question_body'];
            $point = $row['point'];
            $course_id = $row['course_id'];
            $subject_id= $row['subject_id'];
            $difficultylevelid = $row['difficultylevel_id'];
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
      <div class="page-header"><h1>添加一道选择题</h1></div>
      <form name="question_form" id="question_form"  class="form-horizontal" 
        role="form" method="post" onsubmit="return onSubmitQForm();">
        <fieldset>
            <legend>概要</legend>
            <input type="hidden" name="hidden_question_id" id="hidden_question_id" value="<?php echo (!empty($id) ? $id: '')?>">
         <div id="item_question_name" class="form-group">
            <div class="col-sm-2 control-label">
            <label for="question_name">题目名称</label></div>
            <div class="col-sm-8 col-lg-8">
                <input id="question_name" name="question_name"
                    class="form-control"  required 
                    value="<?php echo !empty($question_name) ? $question_name: ''?>"></input>
                <div class="help-block with-errors"></div>
            </div>
         </div>
         <div id="item_question_body" class="form-group">
           <div class="col-sm-2 control-label">
           <label for="question_text">题干</label></div>
           <div class="col-sm-8 col-lg-8">
           <textarea id="question_body" name="question_body" rows="5"  
            class="field  form-control" required ><?php echo !empty($qbody) ? $qbody:''?></textarea>
                <input type="hidden" value="multichoice" name="qtype">
                <div class="help-block with-errors"></div>
           </div>
         </div>
         <div id="qitem_course" class="form-group">
            <div class="col-sm-2 control-label">
            <label for="question_mark">课程</label></div>
            <div class="col-sm-8">
                <select id="qitem_course_id" name ="qitem_course_id" class="form-control ">
                    <option value="">--请选择课程--</option>
                <?php 
                    $courses = getCourses();
                    if ($courses->num_rows >0){
                        foreach ($courses as $course){
                            $courseselected = ($course_id == $course['course_id']) ? "selected": "";
                            echo  '<option value="'.$course['course_id'].'" '.$courseselected.' >'.$course['coursename'].'</option>';
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
           <div class="col-sm-8">
            <select id="qitem_subject_id"  name="subject_id" class="form-control">
                <option value="">--请选择知识点--</option>
            <?php
            $query = "select * from tk_subjects order by subject_id;";

            $result = $DB->query($query) or die(exit(mysqli_error($DB)));

            if ($result->num_rows >0){
                foreach ($result as $row){
                    $selected = ($subject_id == $row['subject_id']) ? "selected": "";
                    echo  '<option value="'.$row['subject_id'].'" '.$selected.' >'.$row['subjectName'].'</option>';
                }
            }
            ?>
            </select>
           </div>
         </div>
         <div class="form-group">
            <div class="col-sm-2 control-label" >
            <label for="difficultylevel_list">难度</label></div>
            <div class="col-sm-8">
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
            <label for="question_mark">分数</label></div>
            <div class="col-sm-3">
                <input id="question_mark" name="question_mark" class="form-control"  value="<?php echo !empty($point) ? $point: ''?>"></input>
                <div class="help-block with-errors"></div>
            </div>
         </div>
         </fieldset>
         <fieldset>
            <legend>选项</legend>
           
            <?php
    if (!empty($question_id)){
        $query = "select * from tk_question_answers where question_id=". $question_id;
    
        $answerresult = $DB->query( $query);
    
        if ($answerresult->num_rows >0){
            $optionorder = 1;
            $checked = null;
            foreach( $answerresult as $answerrow ){
                $qanswer_id = $answerrow['id'];
                $optionvalue= (!empty($answerrow['answer'])) ?$answerrow['answer'] : '';
                $checked = ($answerrow['iscorrectanswer'] == 1) ? 'checked' : '';
      ?>
                
         <div class=" form-group">
           <div class="col-sm-2 col-lg-2 control-label qitem_title">
              <label for="qitem_answer<?php echo $optionorder;?>">选项<?php echo $optionorder;?></label>
              <input type="hidden" name="qanswer_id<?php echo $optionorder;?>" value="<?php echo $qanswer_id;?>">
           </div>
           <div class="col-sm-8 col-lg-8 qitem_content">
               <div class="col-sm-8 col-lg-8">
                    <textarea type="text" id="qitem_answer<?php echo $optionorder;?>"
                      name="qitem_answer<?php echo $optionorder;?>" required class="form-control" '
                       value="<?php echo $optionvalue;?>" row="3"></textarea>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-sm-8 col-lg-8">
                    <label  for="check_option<?php echo $optionorder;?>">
                      <input type="checkbox" id="check_option<?php echo $optionorder;?>" 
                        name="check_options[]"  value="<?php echo $optionorder;?>"<?php echo $checked;?>>本选项是正确答案
                    </label>
                    </div>
               </div>
           </div>
               
      <?php 
                $optionorder ++;
            }
        }
    }else{
       
       for($index = 1; $index <= 4; $index +=1 ){
?>
        <div class=" form-group qitem">
            <div class="col-sm-2 col-lg-2 control-label qitem_title">
                <label for="qitem_answer<?php echo $index;?>">选项<?php echo $index;?></label>
            </div>
            <div class="col-sm-10 col-lg-10 qitem_content">
            <div class="col-sm-10 col-lg-8">
                <input type="text" id="qitem_answer<?php echo $index;?>"
                     name="qitem_answer<?php echo $index;?>" required
                     class="form-control" ></input>
                <div class="help-block with-errors"></div>
             </div>
             <div class="col-sm-10 col-lg-8">
                <label class="checkbox" for="check_option<?php echo $index;?>"> 
                  <input type="checkbox" id="check_option<?php echo $index;?>" 
                  name="check_options[<?php echo $index;?>]">本选项是正确答案
                </label>
            </div>
            </div>
        </div>

<?php 
       }
    }
?>     
            
         </fieldset>

       <div class="form-group">
        <div  class="col-sm-8 col-sm-offset-2">
          <button type="submit" class="btn btn-success">保存</button>
          <button type="button" class="btn btn-default" onclick="history.back();" >取消</button>
          </div>
       </div>
      </form>
    </div>
   <!--  <footer class="footer">
      <div class="container">
        <p class="text-muted">Copyright.</p>
      </div>
    </footer> -->
      <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../lib/jquery/jquery-3.1.1.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    
    <!-- <script src="../../script/form-validator.min.js" type="text/javascript"></script> -->
    <script src="script.js" type="text/javascript"></script>
    <script src="../../lib/jqueryvalidation/jquery.validate.js" type="text/javascript"></script>
    <script src="../../lib/bootstrapValidator/js/bootstrapValidator.js" type="text/javascript"></script>
  </body>
</html>