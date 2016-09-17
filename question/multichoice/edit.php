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
      <h2>添加一道试题</h2>
      <form action="addquestion.php" class="form-horizontal" role="form">
      
         <div class="form-group ">
           <div class="col-sm-2 control-label">
             <label  for="subject_list">知识点</label>
           </div>
           <div class="col-sm-3">
            <select id="subject_list" class="form-control"></select>
           </div>
         </div>
         <div class="form-group">
            <div class="col-sm-2 control-label" >
            <label for="difficultylevel_list">难度</label></div>
            <div class="col-sm-3">
            <select id="difficultylevel_list" class="form-control"></select></div>
         </div>
        
         <div id="item_question_body" class="form-group">
           <div class="col-sm-2 control-label">
           <label for="question_text">题干</label></div>
           <div class="col-sm-3"><input id="question_text"></input></div>
         </div>
         <div id="item_question_mark" class="form-group">
            <div class="col-sm-2 control-label">
            <label for="question_mark">分数</label></div>
            <div class="col-sm-3"><input id="question_mark"></input></div>
         </div>
         <div id="item_question_answer" class="form-group">
            <div class="col-sm-2 control-label">
            <label for="question_answer">正确答案</label></div>
            <div class="col-sm-3"><input id="question_answer"></input></div>
         </div>

       <div class="form-group">
        <div  class="col-sm-5 col-sm-offset-2">
          <button type="submit" class="btn btn-success">保存</button>
          <button type="button" class="btn btn-default">取消</button>
          </div>  
       </div>
      </form>
    </div>
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