<?php
    include("../../config.php");

    // write the table header;
    $data = '<table class="table table-striped">
                <thread><tr><th>subject</th><th>Actions</th></tr></thread>
                <tbody>';
    $query = 'select * from tk_subjects order by subjectname;';
    $result = $DB->query($query) or die(exit(mysqli_error($DB)));

    if ($result->num_rows>0){
        foreach ($result as $row){
            $data .= '<tr><td>'.$row['subjectName'].'</td>';
            $data .= '<td><a title="Edit" onclick="getSubjectDetails('.$row['subject_id'].')"
                        data-toggle="modal" data-target="#edit_subject_modal" data-backdrop="false" >
                        <img src="'. $CFG->wwwroot.'/images/gear.png"
                                alt="edit" class="iconsmall" /></a>
                        <a class="delete_product" data-id="'.$row['subject_id'].'"  
                            data-toggle="modal" data-target="#delete_subject_modal" data-backdrop="false">
                            <i class="glyphicon glyphicon-trash"></i></a></td>';

            $data .= '</tr>';
        }
    }else{
        $data .= '<tr><td colspan="2">No data found</td></tr>';
    }

    echo $data;