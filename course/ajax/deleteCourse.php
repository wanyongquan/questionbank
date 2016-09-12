<?php
    require_once '../../config.php';

    if (isset($_REQUEST['id'])){
        $courseid = $_REQUEST['id'];
        $query = "delete from tk_courses where course_id =".$courseid;
        $result = mysqli_query($DB, $query);
        if ($result){
            echo "Course deleted successfully ...";
        }
    }