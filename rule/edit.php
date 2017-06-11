<?php

    include_once '../config.php';

    include_once '../session.php';
    include_once '../lib/dblib.php';
    
    if (isset($_SESSION['ruletype'])){
        $ruletype = $_SESSION['ruletype'];
    }

    $id = null;
    $rule_id=null;
    $rule_name= null;
    $qbody = null;
    $point = null;
    $course_id=null;
    $subject_id=null;
    $difficultylevelid = null;
    
    if (!empty($_GET['id'])){
        $id = $_REQUEST['id'];
    }

    if (null != $id ){
        // for edit a existing rule
        // get rule details and show on page
        $query = "select * from tk_rules "
                ." left join tk_subjects on tk_subjects.subject_id = tk_rules.subject_id"
                ." left join vw_difficultylevels on vw_difficultylevels.dictionary_id = tk_rules.difficultylevel_id"
                . " where tk_rules.rule_id=$id" ;
        $result = mysqli_query($DB, $query);
        if (!$result ){
            //error
        }else{
            $row = mysqli_fetch_assoc($result);
            $rule_id= $row['rule_id'];
            $rule_name= $row['rule_name'];
            $qbody = $row['rule_body'];
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
    /**
     * Display menus for logged in users
     */
if (isset ( $_SESSION['username'])){
         include '../include/menus.php';
        }?>
    <div id="content" class="container">
      <div class="page-header"><h2>修改组卷规则</h2></div>
      <form name="rule_form" id="rule_form"  class="form-horizontal" 
        role="form" method="post" onsubmit="return onSubmitQForm();">
        
        <fieldset>
            <legend>基本信息</legend>
            <input type="hidden" name="hidden_rule_id" id="hidden_rule_id" value="<?php echo (!empty($id) ? $id: '')?>">
          <div class="row">
            <div class="col-lg-12"> 
           <div class="col-sm-2 control-label">
             <label for="rule_name">规则名称</label>
            </div>            
           <div class="col-sm-4 col-md-6 col-lg-10" >
            <div id="item_rule_name" class="form-group">
                <input id="rule_name" name="rule_name"
                    class="form-control"  required 
                    value="<?php echo !empty($rule_name) ? $rule_name: ''?>"></input>
                <div class="help-block with-errors"></div>
            </div>
           </div>
          </div>
         </div><!-- end of row -->
         <div class="row"> 
          <div class="col-lg-12">
           <div class="col-sm-2 control-label">
             <label for="exam_time">考试时间</label>
            </div>
           <div class="col-sm-4 col-md-6 col-lg-10" >
            <div id="item_exam_time" class="form-group">
                <input id="exam_time" name="exam_time"
                    class="form-control"  required 
                    value="<?php echo !empty($exam_time) ? $exam_time: ''?>"></input>
                <div class="help-block with-errors"></div>
            </div>
         </div>
         </div>
         </div> <!-- end of row -->
         <div class="row">
           <div class="col-lg-12">
             <div class="col-sm-2 control-label">
             </div>
             <div class="col-sm-4 col-md-6 col-lg-10">
             <div class="form-group">
               <button type="submit" class="btn btn-primary">保存</button>
             </div>
           </div>
           </div>
        </div>
       </fieldset>  
     </form> <!-- end of rule general info form -->
     <form>  
       <fieldset>
         <legend>规则内容</legend>  
         <div class="col-lg-12">
         <div id="item_rule_options" class="form-group">
           <div class="col-sm-3 col-md-3 col-lg-3">
           <div class="panel panel-default">
             <div class="panel-heading"><label>type</label></div>
            <div class="panel-body">
                <select id="qtype_opt" name="qtype_opt">
                  <option>choice</option>
                  <option>short answer</option>
                </select>
            </div>
            </div>
           </div>
           <div class="col-sm-3 col-lg-3">
            <div class="panel panel-default">
              <div class="panel-heading">
                <label>subject</label>
              </div>
              <div class="panel-body">
                <select id="qsubject_opt" name="qsubject_opt">
                  <option>chap1</option>
                  <option>chap2</option>
                </select> 
              </div>
            </div>
           </div>
           <div class="col-sm-3 col-lg-3">
            <div class="panel panel-default">
              <div class="panel-heading">
                <label>numbers</label>
              </div>
              <div class="panel-body">
                <input type="text" id="qnumbers_opt" name="qnumbers_opt" size="5">
              </div>
            </div>
           </div>
           <div class="col-sm-3 col-lg-3">
             <div class="panel panel-default">
              <div class="panel-heading">
                <label>level</label>
              </div>
              <div class="panel-body">
                <select id="qlevel_opt" name="qlevel_opt">
                   <option>easy</option>
                   <option>hard</option>
                 </select> 
              </div>
            </div>
           </div>
         </div>
         </div>
         </fieldset>
         
           <div class="col-sm-3 col-lg-12">
             <div class="form-group">
               <button type="submit" class="btn btn-primary">新增</button>
             </div>
           </div>
                       

      </form>
      <div class="row">
        <div class="col-lg-12">
          <table class="table table-striped table-hover">
                <thead>
                   <tr><th>type</th><th>subject</th><th>numbers</th><th>level</th><th>actions</th> </tr>
                </thead>
                <tbody>
                  <tr><td>single choice</td><td>1st chapter</td><td>5</td><td>middle</td><th>remove</th></tr>
                </tbody>
            </table>
            
        </div>
      </div>
       <div class="col-sm-3 col-lg-12">
         <div class="form-group">
           <button type="submit" class="btn btn-primary">保存</button>
         </div>
       </div>
    </div>
   <!--  <footer class="footer">
      <div class="container">
        <p class="text-muted">Copyright.</p>
      </div>
    </footer> -->
      <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../lib/jquery/jquery-3.1.1.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    
    <!-- <script src="../../script/form-validator.min.js" type="text/javascript"></script> -->
    <script src="script.js" type="text/javascript"></script>
    <script src="../../lib/jqueryvalidation/jquery.validate.js" type="text/javascript"></script>
    <script src="../../lib/bootstrapValidator/js/bootstrapValidator.js" type="text/javascript"></script>
  </body>
</html>