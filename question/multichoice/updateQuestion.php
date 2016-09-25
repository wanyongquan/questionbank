<?php

    session_start();
    require_once '../../config.php';
    require_once '../../lib/datelib.php';
    
    // get the form data
    if (isset($_POST['hidden_question_id'])){
        $question_id = $_POST['hidden_question_id'];
        $qtype = $_POST['qtype'];
        $qbody = $_POST['question_body'];
        $difficultyLevel_id = $_POST['difficultyLevel_id'];
        $subject_id = $_POST['subject_id'];
        $qmark = $_POST['question_mark'];
        $user_id = $_SESSION['userid'];
        
        // start the transaction 
        $DB->autocommit(false);
        
        // step 1: update table tk_questions
        $updatedDate = null;
        $updatedBy = $user_id;
        $query = "update tk_questions set subject_id=$subject_id ,";
        $query .= " difficultyLevel_id = $difficultyLevel_id,";
        $query .= " question_body = '$qbody',";
        $query .= " point = $qmark ";
        $query .= " where question_id=$question_id ;";
        
        $result = mysqli_query($DB, $query) or die (exit (mysqli_error($DB)));
        
        // step 2, update table tk_question_answers
        $stmt = $DB->prepare("update tk_question_answers set answer =?, iscorrectanswer=?;");
        $stmt->bind_param("ss", $answer_option, $option_is_true_answer);
        // option 1
        $answer_option = $_POST['question_answer_option1'];
        $option_is_true_answer = isset($_POST['check_option1'])? true:false;
        $stmt->execute();
        
        // option 2
        $answer_option = $_POST['question_answer_option2'];
        $option_is_true_answer = isset($_POST['check_option2'])? true:false;
        $stmt->execute();
        
        // option 3
        $answer_option = $_POST['question_answer_option3'];
        $option_is_true_answer = isset($_POST['check_option3'])? true:false;
        $stmt->execute();
        
        // option 4
        $answer_option = $_POST['question_answer_option4'];
        $option_is_true_answer = isset($_POST['check_option4'])? true:false;
        $stmt->execute();
        // submit
        $stmt->close();
        $DB->commit();
        // redirect
        header("location:../question.php");
        
    }