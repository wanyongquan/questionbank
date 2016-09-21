<?php
    include_once '../../config.php';

    include_once '../../session.php';

    if (isset($_POST['questiontype'])){
        $questiontype = $_POST['questiontype'];

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
    <link href="<?php echo $CFG->wwwroot.'/bootstrap/css/bootstrap.min.css'?>" rel="stylesheet">
    <link href="../../css/bootstrap.css" rel="stylesheet">
    <link href="../../css/nav-sidebar.css" rel="stylesheet">
    
    <title>Question Bank </title>
    </head>
    <body>
    <?php if (isset($_SESSION['username'])){
         include '../../include/menus.php';
        }?>
    <div id="content" class="container">
      <div class="page-header"><h1>添加一道试题</h1></div>
      <form action="addquestion.php" class="form-horizontal" role="form" method="post">
        <fieldset>
            <legend>概要</legend>
         <div class="form-group ">
           <div class="col-sm-2 control-label">
             <label  for="subject_list">知识点</label>
           </div>
           <div class="col-sm-3">
            <select id="subject_list"  name="subject_id" class="form-control"></select>

           </div>
         </div>
         <div class="form-group">
            <div class="col-sm-2 control-label" >
            <label for="difficultylevel_list">难度</label></div>
            <div class="col-sm-3">
            <select id="difficultylevel_list"  name="difficultyLevel_id" class="form-control"></select></div>
         </div>

         <div id="item_question_body" class="form-group">
           <div class="col-sm-2 control-label">
           <label for="question_text">题干</label></div>
           <div class="col-sm-10">
           <textarea id="question_body" name="question_body" rows="7" class="field col-sm-12"></textarea>
                <input type="hidden" value="multichoice" name="qtype"></input>
           </div>
         </div>
         <div id="item_question_mark" class="form-group">
            <div class="col-sm-2 control-label">
            <label for="question_mark">分数</label></div>
            <div class="col-sm-3"><input id="question_mark" name="question_mark"></input></div>
            
         </div> 
         </fieldset>
         <fieldset>
            <legend>选项</legend>
          <div class=" form-group">
           <div class="col-sm-2 control-label">
                <label for="question_answer_option1">选项1</label></div>
              <div class="col-sm-10">
                <input type="text" id="question_answer_option1" 
                name="question_answer_option1" class="form-control"></input>     
                <label class="checkbox" for="check_option1">
                <input type="checkbox" id="check_option1" name="check_option1">是正确选项</label>
                </div>
           </div>
           <div class=" form-group">
           <div class="col-sm-2 control-label " >
                <label for="question_answer_option2">选项2</label></div>
                <div class="col-sm-10">
                    <input type="text" id="question_answer_option2"
                     name="question_answer_option2" class="form-control"></input>
                    <label class="checkbox" for="check_option2">
                    <input type="checkbox" name="check_option2">是正确选项</label></div>
           </div>
            <div class=" form-group">
           <div class="col-sm-2 control-label " >
                <label for="question_answer_option3">选项3</label></div>
                <div class="col-sm-10">
                    <input type="text" id="question_answer_option3" 
                    name="question_answer_option3" class="form-control"></input>
                    <label class="checkbox" for="check_option3">
                    <input type="checkbox" name="check_option3">是正确选项</label></div>
           </div>
           <div class=" form-group">
           <div class="col-sm-2 control-label " >
                <label for="question_answer_option4">选项4</label></div>
                <div class="col-sm-10">
                    <input type="text" id="question_answer_option4" 
                    name="question_answer_option4" class="form-control"></input>
                    <label class="checkbox" for="check_option4">
                    <input type="checkbox" name="check_option4">是正确选项</label></div>
           </div>
         </fieldset>

       <div class="form-group">
        <div  class="col-sm-8 col-sm-offset-2">
          <button type="submit" class="btn btn-success">保存</button>
          <button type="button" class="btn btn-default">取消</button>
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
    <script
        src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../script/form-validator.min.js" type="text/javascript"></script>
    <script src="script.js" type="text/javascript"></script>
    </body>
</html>