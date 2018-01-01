<?php
    require_once '../../config.php';
    require_once '../lib.php';
    
$courseid = $_REQUEST['courseid'];
if (isset($_REQUEST['subjectid'])){
    $subjectid =  $_REQUEST['subjectid'];
}
if (!isset($subjectid)){
    $questions = getQuestionsByCourseId($courseid);
}else{
    $questions = getQuestionsByCourseIdAndSubjectId($courseid, $subjectid);
}
foreach($questions as $question){
  ?>
<div class="widget-box">
  <div class="widget-header widget-header-flat widget-header-small">
      <div class="grid4">
        <label class="widget-title">题型: <?php echo $question['qtype']?></label>
      </div>
      <div class="grid4">
          <label>难度: <?php echo $question['difficulty']?></label>
      </div>  
  </div>
  <div class="widget-body">
    <div class="widget-main">
      <p><?php echo $question['question_body'];?></p>
    </div>
    <div class="hr hr8 hr-doubles"></div>
    <div class="clearfix">
      <div class="grid4">组卷次数：0 </div>
      <div class="pull-right widget-toolbar">
        <button type="button" class="btn btn-success btn-xs">+选题</button>  
      </div>
    </div>
  </div>

</div>
<?php
}
