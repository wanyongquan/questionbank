<?php
include ('../../config.php');
if (isset ( $_POST ['field-name'] )) {
    // include database file
    // include($CFG->wwwroot."/dblib.php");
    
    // get values
    $courseid = $_POST['courseid'];
    $rulename = $_POST ['field-name'];
    $description = $_POST ['field-desc'];
    $difficulty = $_POST ['field_difficulty'];
    $includefillblank = $_POST ['field-checkbox-1'];
    $includeshortanswer = $_POST ['field-checkbox-2'];
    $includechoice = $_POST ['field-checkbox-4'];
    $includeComprehensive = $_POST ['field-checkbox-8'];
    
    $number_fillblank = $_POST ['field-number-1'];
    $number_shortanswer = $_POST ["field-number-2"];
    $number_choice = $_POST ['field-number-4'];
    
    $query = "insert into tk_paper_rules(name,course_id) values ('$rulename', $courseid)";
    
    global $DB;
    // start the transition
    $DB->autocommit ( false );
    // save rule data to table tk_paper_rules
    if (! $result = mysqli_query ( $DB, $query )) {
        exit ( mysqli_error ( $DB ) );
    }
    
    $ruleid = $DB->insert_id; // get the id of new inserted row;
    $statement = $DB->prepare ( "insert into tk_paper_rule_options (rule_id,qtype,qnumber) values(?,?,?)" );
    $statement->bind_param ("isi", $ruleid, $qtype, $qnumber );
    
    // fillblank
    if (isset ( $includefillblank ) && $includefillblank == true) {
        $qtype="fillblank";
        $qnumber = $_POST ['field-number-1'];
        $statement->execute();
    }
    // shortanswer
    if (isset ( $includeshortanswer ) && $includeshortanswer == true) {
        $qtype="shortanswer";
        $qnumber = $_POST ['field-number-2'];
        $statement->execute();
    }
    // multichoice
    if (isset ( $includechoice ) && $includechoice == true) {
        $qtype="multichoice";
        $qnumber = $_POST ['field-number-4'];
        $statement->execute();
    }
    
    // submit the transaction
    $statement->close();
    $DB->commit();
    
    //redirect 
    header("location:../view.php?courseid=$courseid");
}
