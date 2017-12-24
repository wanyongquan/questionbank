<?php
    require_once '../config.php';
    
    $query = "select subject_id,subject_name from tk_subjects order by subject_name;";
    
    $result = $DB->query($query) or die(exit(mysqli_error($DB)));
    $data='';
    if ($result->num_rows >0){
        foreach ($result as $row){
            $data .= '<option value="'.$row['subject_id'].'>'.$row['subject_name'].'</option>';
        }
    }
    echo $data;