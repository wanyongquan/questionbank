<?php
/**
 * This library contains all the data manipulation languate functions used to interact with the DB
 */
mysqli_report ( MYSQLI_REPORT_STRICT );
function setupDB() {
    global $CFG, $DB;

    if (isset ( $DB )) {
        return;
    }

    if (! isset ( $CFG->dbuser )) {
        $CFG->dbuser = '';
    }

    if (! isset ( $CFG->dbpass )) {
        $CFG->dbpass = '';
    }

    if (! isset ( $CFG->dbname )) {
        $CFG->dbname = '';
    }

    try {
        // $DB->connect($CFG->dbhost, $CFG->dbuser, $CFG->dbpass);
        $DB = mysqli_connect ( $CFG->dbhost, $CFG->dbuser, $CFG->dbpass, $CFG->dbname );
        mysqli_set_charset($DB, "utf8");
    } catch ( exception $e ) {
        //
        echo $e->getMessage ();
        throw $e;
    }

    return true;
}

function query($sql){
    global $DB;
   $result = mysqli_query($DB, $sql)  or die( exit(mysqli_error($DB))) ;

}

function getCourses(){
    GLOBAL $DB;
    
    $sql = "select * from tk_courses";
    $result = mysqli_query($DB, $sql);
    return $result;
}

function getSubjectsByCourseId($courseId){
    GLOBAL $DB;
    
    $sql = "select subject_id,subject_name from tk_subjects, tk_courses where tk_subjects.course_id = tk_courses.course_id";
    $sql .= " and tk_subjects.course_id = ".$courseId. " order by subject_name";
    
    $result = mysqli_query($DB, $sql);
    
    return $result;
    
}

function getAllCourses(){
    global $DB;

    $sql = "select course_id, course_name from tk_courses";
    $result = mysqli_query($DB, $sql);
    return $result;
}