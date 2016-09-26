<?php
    if (!empty($question_id)){
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
                name="question_answer_option'.$optionorder.'" required class="form-control" '
                   .'value="'. $optionvalue .'"></input><div class="help-block with-errors"></div>'
               .' <label class="checkbox" for="check_option'.$optionorder.'">
                <input type="checkbox" id="check_option'.$optionorder.'" name="check_option'.$optionorder.'" '. $checked.'>是正确选项</label>
                </div>
           </div>';
                echo $option;
                $optionorder ++;
            }
        }
    }else{
?>
<div class=" form-group">
       <div class="col-sm-2 control-label">
            <label for="question_answer_option1">选项1</label></div>
          <div class="col-sm-10">
            <input type="text" id="question_answer_option1" placeholder="Please enter option content" data-error="please enter xxx"
                name="question_answer_option1" required class="form-control"></input>
             <div class="help-block with-errors"></div>  
         <label class="checkbox" for="check_option1">
            <input type="checkbox" id="check_option1" name="check_option1">是正确选项</label>
             
            </div>
       </div>
       <div class=" form-group">
       <div class="col-sm-2 control-label " >
            <label for="question_answer_option2">选项2</label></div>
            <div class="col-sm-10">
                <input type="text" id="question_answer_option2"
                 name="question_answer_option2" required class="form-control"></input>
                 
                <label class="checkbox" for="check_option2">
                <input type="checkbox" name="check_option2" >是正确选项</label></div>
                <div class="help-block with-errors"></div>
       </div>
        <div class=" form-group">
       <div class="col-sm-2 control-label " >
            <label for="question_answer_option3">选项3</label></div>
            <div class="col-sm-10">
                <input type="text" id="question_answer_option3"
                name="question_answer_option3" required class="form-control"></input>
                <div class="help-block with-errors"></div>
                <label class="checkbox" for="check_option3">
                <input type="checkbox" name="check_option3">是正确选项</label></div>
       </div>
       <div class=" form-group">
       <div class="col-sm-2 control-label " >
            <label for="question_answer_option4">选项4</label></div>
            <div class="col-sm-10">
                <input type="text" id="question_answer_option4"
                name="question_answer_option4" required class="form-control"></input>
                <div class="help-block with-errors"></div>
                <label class="checkbox" for="check_option4">
                <input type="checkbox" name="check_option4">是正确选项</label></div>
       </div>

<?php }?>