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
           <div class="col-sm-10 col-lg-10 qitem_content">
               <div class="col-sm-10 col-lg-8">
                    <input type="text" id="qitem_answer<?php echo $optionorder;?>"
                      name="qitem_answer<?php echo $optionorder;?>" required class="form-control" '
                       value="<?php echo $optionvalue;?>"></input>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-sm-10 col-lg-8">
                    <label  for="check_option<?php echo $optionorder;?>">
                      <input type="checkbox" id="check_option<?php echo $optionorder;?>" 
                        name="check_options[<?php echo $optionorder;?>]" <?php echo $checked;?>>本选项是正确答案
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
            placeholder="请输入选项内容"
             name="qitem_answer<?php echo $index;?>" required
             class="form-control"></input>
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
