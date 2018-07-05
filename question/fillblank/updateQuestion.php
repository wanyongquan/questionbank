<?php

    require_once '../../config.php';
    require_once '../../lib/datelib.php';
    
    // get the form data
    $returnurl = $_POST['returnurl'];
    if (isset($_POST['questionid'])){
        $question_id = $_POST['questionid'];
        $qtype = $_POST['qtype'];
        $qbody = $_POST['question_body'];
        $difficultyLevelId = $_POST['difficultyLevel_id'];
        $subject_id = $_POST['subject_id'];
        $qmark = $_POST['question_mark'];
        //TODO: use real user id
        $user_id = 1;// $_SESSION['userid'];
        
        // start the transaction 
        $DB->autocommit(false);
        
        // step 1: update table tk_questions
        $updatedDate = null;
        $updatedBy = $user_id;
        $query = "update tk_questions set subjectid=$subject_id ,";
        $query .= " difficultyLevel_id = $difficultyLevelId,";
        $query .= " question_body = '$qbody',";
        $query .= " point = $qmark ";
        $query .= " where question_id=$question_id ;";
        
        $result = mysqli_query($DB, $query) or die (exit (mysqli_error($DB)));
        
        // step 2, update table tk_question_answers
        $stmt = $DB->prepare("update tk_question_answers set answer =?, iscorrectanswer=? where question_id=? and id=?;");
        $stmt->bind_param("ssii", $answer_option, $option_is_true_answer, $question_id, $qanswer_id);
        // option 1
        $qanswer_id = $_POST['qanswer'];
        $answer_option = $_POST['answer'];
        $option_is_true_answer = isset($_POST['is_correct'])? true:false;
        $stmt->execute();
        
        /* // option 2
        $qanswer_id = $_POST['qanswer_b'];
        $answer_option = $_POST['optionb'];
        $option_is_true_answer = isset($_POST['is_correct_b'])? true:false;
        $stmt->execute();
        
        // option 3
        $qanswer_id = $_POST['qanswer_c'];
        $answer_option = $_POST['optionc'];
        $option_is_true_answer = isset($_POST['is_correct_a'])? true:false;
        $stmt->execute();
        
        // option 4
        $qanswer_id = $_POST['qanswer_d'];
        $answer_option = $_POST['optiond'];
        $option_is_true_answer = isset($_POST['is_correct_a'])? true:false;
        $stmt->execute(); */
        // submit
        $stmt->close();
        $DB->commit();
        // redirect
        header("location:$returnurl");
    }