<?php
    $query = "select * from tk_question_answers where question_id=". $question_id;

    $answerresult = $DB->query( $query);

    if ($answerresult->num_rows >0){
        $optionorder = 1;
        $checked = null;
        foreach( $answerresult as $answerrow ){
            $optionvalue= (!empty($answerrow['answer'])) ?$answerrow['answer'] : '';
            $checked = ($answerrow['iscorrectanswer'] == 1) ? 'checked' : '';
            $option ='<div class=" form-group">
       <div class="col-sm-2 control-label">
            <label for="question_answer_option'.$optionorder .' ">选项'.$optionorder.'</label></div>
          <div class="col-sm-10">
            <input type="text" id="question_answer_option'.$optionorder.'"
            name="question_answer_option'.$optionorder.'" class="form-control" '
               .'value="'. $optionvalue .'"></input>'
           .' <label class="checkbox" for="check_option'.$optionorder.'">
            <input type="checkbox" id="check_option'.$optionorder.'" name="check_option'.$optionorder.'" '. $checked.'>是正确选项</label>
            </div>
       </div>';
            echo $option;
            $optionorder ++;
        }
    }
?>
<!--
<div class=" form-group">
       <div class="col-sm-2 control-label">
            <label for="question_answer_option1">选项13</label></div>
          <div class="col-sm-10">
            <input type="text" id="question_answer_option1"
            name="question_answer_option1" class="form-control">
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
-->
