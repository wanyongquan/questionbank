<?php
    require_once '../../config.php';

    // check request
    if (isset($_POST['id']) &&  $_POST['id'] != ""){
        // get course id
        $course_id = $_POST['id'];

        // get course fields
        $query = "select * from tk_courses where course_id= $course_id";
        if (!$result = mysqli_query($DB, $query)){
            exit (mysqli_error($DB));
        }

        $response = array();
        if (mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $response = $row;
            }
        }else{
            $response['status'] = 200;
            $response['message']= 'No data found';
        }
        // display json data
        echo json_encode($response);
    }else{
        $response['status'] = 200;
        $response['message']= "Invalid request!";
    }