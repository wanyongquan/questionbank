<?php
    require_once '../config.php';
    
    $query = 'select * from vw_difficultylevels';
    
    $result = $DB->query($query) or die(exit(mysqli_error($DB)));
    $data='';
    if ($result->num_rows > 0){
        foreach ($result as $row){
            $data .='<option value="'.$row['dictionary_id'].'">'.$row['dictionary_value'].'</option>';
        }
    }
    echo $data;
    