<?php
    // include database file
    include( '../../config.php');

    // check request
    if (isset($_POST['id'])){
        // get values from param
        $id = $_POST['id'];
        $coursename = $_POST['coursename'];
        $coursedescription = $_POST['coursedescription'];

        // upcate database table
        $query = "update tk_courses set coursename='$coursename' , description='$coursedescription' where course_id=$id";
        if (!$result = mysqli_query($DB, $query)){
            exit(mysqli_error($DB));
        }

    }