<?php
    include_once '../../config.php';
    
    // write the html table header
    $data = '<table class="table table-striped">
               <thread<tr><th>question type</th>
                            <th>question body</th>
                            <th>level</th>
                            <th>subject</th>
                            <th>point</th>
                            <th>creator</th>
                            <th>createdDate</th>
                            <th>actions</th></thread>
            <tbody>';
    $query = 'select * from tk_questions left join bs_dictionaryitems as dictdata '
            .'on tk_questions.difficultylevel_id = dictdata.dictionary_id order by question_id;';
    $result = $DB->query($query) or die(exit(mysqli_error($DB)));
    
    if ($result->num_rows > 0){
        foreach ($result as $row){
            $data .= '<tr><td>'.$row['question_body'].'<td>';
            $data .= '<td>'.$result['dictionary_value'].'</td>';
            $data .= '<td><a title="Edit" >
                        <img src="'.$CFG->wwwroot.'/images/gear.png" alt="edit" class="iconsmall"/></a>
                        <a class="delete_product" data-id="'.$row['question_id'].'" 
                           data-toggle="modal" data-target="#delete_question_modal" 
                           data-backdrop="false"><i class="glyphicon glyphon-trash"></i></a></td>';
            $data .= '</tr>';
        }
    }else{
        $data .= '<tr><td colspan="3">No data found</td></tr>';
    }
    
    echo $data;