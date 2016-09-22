<?php

    require_once '../../config.php';

    if (isset($_POST['id'])){
        $question_id = $_POST['id'];

        // start the transaction
        $DB->autocommit(false);

        // step 1: delete answer options in table tk_question_answers
        $query = "delete from tk_question_answers where question_id =$question_id";
        $result = mysqli_query($DB, $query) or die(exit(mysqli_error($DB)));

        // step 2: delete the question itself from table tk_questions
        $query = "delete from tk_questions where question_id=$question_id";
        $result = mysqli_query($DB, $query) or die (exit (mysqli_error($DB)));

        $DB->commit();
    }
