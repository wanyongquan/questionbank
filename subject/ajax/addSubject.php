<?php
    include ('../../config.php');
    
    if (isset($_POST['subjectname'] )){
        $subjectname = $_POST['subjectname'];
        $course_id = $_POST['course_id'];
        
        $query = "insert into tk_subjects (subjectname,course_id) values('$subjectname', $course_id)";
        $result = mysqli_query($DB, $query) or die( exit(mysqli_error($DB)) );

        echo ' 1 subject added';
    }