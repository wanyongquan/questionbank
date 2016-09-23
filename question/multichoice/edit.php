<?php
    include_once '../../config.php';

    include_once '../../session.php';

    if (isset($_POST['questiontype'])){
        $questiontype = $_POST['questiontype'];

    }

    $id = null;
    if (!empty($_GET['id'])){
        $id = $_REQUEST['id'];
    }
    if (null == $id){
        header:("location:question.php");
    }

    if (!empty($_POST)){
        //
    }else{
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
            $qbody = $row['question_body'];
            $point = $row['point'];
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
            <select id="subject_list"  name="subject_id" class="form-control">
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
            <div class="col-sm-3">
            <select id="difficultylevel_list"  name="difficultyLevel_id" class="form-control">
            <?php
            $query = 'select * from vw_difficultylevels';

            $result = $DB->query($query) or die(exit(mysqli_error($DB)));

            if ($result->num_rows > 0){
                foreach ($result as $row){
                    $selected = ($difficultylevel_id ==$row['directory_id']) ? "selected" : "";
                    echo '<option value="'.$row['dictionary_id'].'"'. $selected .' >'.$row['dictionary_value'].'</option>';
                }
            }
            ?>
            </select></div>
         </div>

         <div id="item_question_body" class="form-group">
           <div class="col-sm-2 control-label">
           <label for="question_text">题干</label></div>
           <div class="col-sm-10">
           <textarea id="question_body" name="question_body" rows="7" class="field col-sm-12"><?php echo !empty($qbody) ? $qbody:'';?></textarea>
                <input type="hidden" value="multichoice" name="qtype">
           </div>
         </div>
         <div id="item_question_mark" class="form-group">
            <div class="col-sm-2 control-label">
            <label for="question_mark">分数</label></div>
            <div class="col-sm-3"><input id="question_mark" name="question_mark" value="<?php echo !empty($point) ? $point: ''?>"></input></div>

         </div>
         </fieldset>
         <fieldset>
            <legend>选项</legend>
            <?php include 'multichoice_edit_form.php'?>

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