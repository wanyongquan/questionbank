<?php
    include( '../../config.php');
    if(isset($_POST['rulename']) ){
        // include database file
        //include($CFG->wwwroot."/dblib.php");

        // get values
        $rule = $_POST['rulename'];
        $description = $_POST['description'];

        $query = "insert into tk_paper_rules(rule_name) values ('$rule')";
        if (!$result = mysqli_query($DB, $query)) {
            exit (mysqli_error($DB));
        }
       
     }
   ?>