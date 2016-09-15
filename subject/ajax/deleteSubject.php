<?php
    require_once '../../config.php';

    if (isset($_POST['subjectid'])){
        $subjectid = $_POST['subjectid'];

        $query = "delete from tk_subjects where subject_id=$subjectid";
        $result = mysqli_query($DB, $query);
        if ($result){
            echo "Knowldge deleted successfully !";
        }
    }