<?php
    require_once '../config.php';
    
    $query = "select * from tk_subjects order by subject_id;";
    
    $result = $DB->query($query) or die(exit(mysqli_error($DB)));
    $data='';
    if ($result->num_rows >0){
        foreach ($result as $row){
            $data .= '<option value="'.$row['subject_id'].'>'.$row['subjectName'].'</option>';
        }
    }
    echo $data;