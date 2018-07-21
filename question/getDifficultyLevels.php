<?php
    require_once '../config.php';
    $selected_id = $_POST['id'];
    $query = 'select * from vw_difficultylevels';

    $result = $DB->query($query) or die(exit(mysqli_error($DB)));
    $data='';
    if ($result->num_rows > 0){
        foreach ($result as $row){
            $selected = ($selected_id ==$row['directory_id']) ? "selected" : "";
            $data .='<option value="'.$row['item_value'].'"'. $selected .' >'.$row['item_name'].'</option>';
        }
    }
    echo $data;
