<?php
    include ('../../config.php');

    if (isset($_POST['knowledgename'] )){
        $knowledgename = $_POST['knowledgename'];

        $query = "insert into tk_knowledges (knowledgename) values('$knowledgename')";
        $result = mysqli_query($DB, $query) or die( exit(mysqli_error($DB)) );

        echo ' 1 knowledge added';
    }