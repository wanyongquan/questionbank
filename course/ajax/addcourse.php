<?php
    include( '../../config.php');
    if(isset($_POST['coursename']) && isset($_POST['description'])){
        // include database file
        //include($CFG->wwwroot."/dblib.php");

        // get values
        $coursename = $_POST['coursename'];
        $description = $_POST['description'];

        $query = "insert into tk_courses(course_name, description) values ('$coursename', '$description')";
        if (!$result = mysqli_query($DB, $query)) {
            exit (mysqli_error($DB));
        }
        echo "1 course added!";
     }
   ?>